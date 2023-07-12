#!/bin/sh

baseDir=$(cd $(dirname $0);pwd)
rootDir=$baseDir/../../../../

cd $baseDir

cp build.js clean.js package.json tsconfig.json vite.config.ts $rootDir

if [ ! -d $rootDir/pub/assets ]; then
  mkdir $rootDir/pub/assets
fi

if [ ! -d $rootDir/assets ]; then
  mkdir $rootDir/assets
fi

cp -r pub_assets/.htaccess pub_assets/index.php $rootDir/pub/assets

cd $rootDir
npm install
