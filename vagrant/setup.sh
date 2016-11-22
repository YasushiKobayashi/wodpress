#!/bin/sh
sudo yum -y update
sudo yum -y install git
sudo yum -y install gcc make glibc-headers openssl-devel readline libyaml-devel readline-devel sqlite-devel wget expect

sudo /sbin/iptables -F
sudo /sbin/service iptables stop
sudo /sbin/chkconfig iptables off

sudo yum -y install ntp
sudo /sbin/service ntpd start
sudo /sbin/chkconfig ntpd on

#install php7
sudo yum -y remove php-*
sudo yum -y install epel-release
wget http://rpms.famillecollet.com/enterprise/remi-release-6.rpm
sudo rpm -Uvh remi-release-6*.rpm
sudo yum -y install --enablerepo=remi --enablerepo=remi-php70 php php-devel php-mbstring php-pdo php-gd php-mysqlnd php-openssl phpunit

#install httpd
sudo yum -y install httpd
sudo cp -a /vagrant/httpd.conf /etc/httpd/conf/
sudo service httpd start
sudo chkconfig httpd on
sudo chown -R vagrant:vagrant /var/www/html

#install node
DIR="/home/vagrant/.nvm"
if [ -d ${DIR} ]; then
  git clone git://github.com/creationix/nvm.git ~/.nvm
  echo '~/.nvm/nvm.sh' >> ~/.bash_profile
  source ~/.nvm/nvm.sh
  nvm install v6.7.0
  npm install -g webpack bower phantomjs gulp coffee babel
fi

#install mysql
sudo yum -y install mysql mysql-server mysql-devel
sudo service mysqld start
sudo chkconfig mysqld on
expect -c "
spawn mysql_secure_installation
expect \"Enter current password for root (enter for none):\"
send -- \"\n\"
expect \"Set root password? [Y/n]\"
send -- \"Y\n\"
expect \"New password:\"
send -- \"vagrant\n\"
expect \"Re-enter new password:\"
send -- \"vagrant\n\"
expect \"Remove anonymous users? [Y/n]\"
send -- \"Y\n\"
expect \"Disallow root login remotely? [Y/n]\"
send -- \"Y\n\"
expect \"Remove test database and access to it? [Y/n]\"
send -- \"Y\n\"
expect \"Thanks for using MySQL!\"
send -- \"exit\n\"
"

#install composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

#install wp-cli
cd /var/www/html
curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
php wp-cli.phar --info
chmod +x wp-cli.phar
#./wp-cli.phar core download  --locale=ja --path=/var/www/html
