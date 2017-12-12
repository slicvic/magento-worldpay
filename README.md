# Magento WorldPay
A credit card payment method that integrates with WorldPay payment gateway.

## Installation via Composer
In order to pull in the module via composer you will need to create a `composer.json` file in your project root folder.

You need to add following lines to your project's composer.json to tell Composer to check out the module as well as [magento-composer-installer](https://github.com/Cotya/magento-composer-installer) to install the module.

Make sure to set `magento-root-dir` to the directory where your Magento resides (relative to your project's composer.json).
```
{
    "require": {
        "magento-hackathon/magento-composer-installer": "*",
        "slicvic/magento-worldpay": "master"
    },
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/magento-hackathon/magento-composer-installer"
        },
        {
            "type": "vcs",
            "url": "https://github.com/slicvic/magento-worldpay.git"
        }
    ],
    "extra":{
        "magento-root-dir": ".",
        "magento-deploystrategy": "copy"
    }
}
```


## Screenshots

![Alt text](https://user-images.githubusercontent.com/4705073/33864262-e74a9818-deb9-11e7-9848-1d98e48da104.png)

![Alt text](https://user-images.githubusercontent.com/4705073/33864261-e737f87a-deb9-11e7-8c1c-8b6f7118f4e1.png)

![Alt text](https://user-images.githubusercontent.com/4705073/33864718-17c26654-debc-11e7-8866-b9b6c446a9d1.png)
