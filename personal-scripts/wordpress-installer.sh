#!/bin/bash

curl -LOk http://wordpress.org/latest.tar.gz
tar -xzvf latest.tar.gz
mv wordpress/* .
rm -R wordpress/
rm latest.tar.gz
mkdir wp-content/uploads
chmod 777 wp-content/uploads

echo "installing npm components"
npm install

#installing adminer
echo "downloading adminer.php"
curl -o adminer.php http://downloads.sourceforge.net/project/adminer/Adminer/Adminer%204.2.2/adminer-4.2.2.php?r=http%3A%2F%2Fsourceforge.net%2Fprojects%2Fadminer%2F&ts=1441852424&use_mirror=nchc 

echo "done"
