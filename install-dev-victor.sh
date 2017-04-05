#!/bin/bash
#
# Module install script for local dev.

magentoRootPath="/Users/$USER/Code/magento19/root"

rm $magentoRootPath/app/etc/modules/Slicvic_WorldPay.xml
rm -R $magentoRootPath/app/code/local/Slicvic/WorldPay/

cp -R ./src/app/etc/modules/Slicvic_WorldPay.xml $magentoRootPath/app/etc/modules/Slicvic_WorldPay.xml
cp -R ./src/app/code/local/Slicvic/WorldPay/ $magentoRootPath/app/code/local/Slicvic/WorldPay/
