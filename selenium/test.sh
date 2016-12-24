#!/bin/sh
source ~/.nvm/nvm.sh
cd /var/www/html/public && npm install
cd /var/www/html/public && gulp sasstest

cd /vagrant/test && npm install
cd /vagrant/test
for FILENAME in `ls *.js`
do
	node ${FILENAME}
done
