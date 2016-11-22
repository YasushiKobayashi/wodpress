#!/bin/sh
sudo yum -y update
sudo yum -y install git gcc make glibc-headers openssl-devel readline libyaml-devel readline-devel sqlite-devel wget expect

#install php7
sudo rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-6.rpm
sudo yum -y install libwebp --disablerepo=amzn-main --enablerepo=epel
sudo yum -y install libmcrypt libtool-ltdl libtidy libXpm libtiff gd-last autoconf automake
sudo yum -y install --disablerepo=amzn-main --enablerepo=remi-php70 php php-opcache php-devel php-mbstring php-mcrypt php-phpseclib-crypt-blowfish php-pecl-apc php-gd php-mysqlnd php-xml php-pdo php-openssl php-unit

#install httpd
sudo yum -y install httpd
sudo cp -a /vagrant/httpd.conf /etc/httpd/conf/
sudo service httpd start
sudo chkconfig httpd on
sudo chown -R git:git /var/www/html

#monit root
yum -y install monit
echo '*/30 * * * * monitor all' >> /var/spool/cron/root
touch /etc/monit.d/set_mail
cat <<EOF > /etc/monit.d/set_mail
set mail-format {
    from: monit@$HOST
    subject: monit alert --  $EVENT $SERVICE
    message: $EVENT Service $SERVICE
        Date:        $DATE
        Action:      $ACTION
        Host:        $HOST
        Description: $DESCRIPTION

        Your faithful employee,
        Monit
}
EOF

touch /etc/monit.d/httpd
cat <<EOF > /etc/monit.d/httpd
check process httpd with pidfile /var/run/httpd.pid
  start program = "/etc/init.d/httpd start" with timeout 60 seconds
  stop program  = "/etc/init.d/httpd stop"
  if failed port 80 protocol http
     then restart
  group apache
EOF

# git
git clone git://github.com/creationix/nvm.git ~/.nvm
echo '~/.nvm/nvm.sh' >> ~/.bash_profile
source ~/.nvm/nvm.sh
nvm install v6.7.0
npm install -g webpack bower phantomjs gulp coffee babel
