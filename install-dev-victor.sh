#!/bin/bash
#
# Module install script for local dev.

magentoRootPath="/Users/$USER/Code/magento19/root"

rm $magentoRootPath/app/etc/modules/Wfn_WorldPay.xml
rm -R $magentoRootPath/app/code/local/Wfn/WorldPay/

cp -R ./src/app/etc/modules/Wfn_WorldPay.xml $magentoRootPath/app/etc/modules/Wfn_WorldPay.xml
cp -R ./src/app/code/local/Wfn/WorldPay/ $magentoRootPath/app/code/local/Wfn/WorldPay/
