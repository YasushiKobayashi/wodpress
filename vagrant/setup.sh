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
mysql -u root -e "create database wordpress default charset utf8"


#install composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

#install wp-cli
cd /var/www/html
curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
php wp-cli.phar --info
chmod +x wp-cli.phar
# php wp-cli.phar core download --locale=ja --path=/var/www/html
php wp-cli.phar core config --dbname=wordpress --dbuser=root --dbhost=127.0.0.1 --path=/var/www/html
php wp-cli.phar core install --admin_name=admin --admin_password=admin --admin_email=admin@example.com --url=http://192.168.34.60 --title=WordPress --path=/var/www/html
php wp-cli.phar theme activate wp-themes --path=/var/www/html