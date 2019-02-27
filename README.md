# Craft CMS 3 - sSMTP Mailer

This mailer for Craft CMS 3 is a simple replacement for Sendmail, using sSMTP.

More information about sSMTP [can be found here](https://wiki.archlinux.org/index.php/SSMTP)

## Install plugin

Use the Craft Plugin Store or use composer

```bash
# go to the project directory
cd /path/to/my-project.test

# tell Composer to load the plugin
composer require bertoost/craft-ssmtpmailer

# OR only for development
# composer require bertoost/craft-ssmtpmailer --dev

# tell Craft to install the plugin
./craft install/plugin ssmtpmailer
```

## Executed command

This adaptor is using the Swiftmailer Sendmail Transport literally. It is extending it and just replaces the command to execute.

The next command is used for sSMTP to send your email.

```
/usr/sbin/ssmtp -t
```

## Configure it for development only

Since Craft 3, you can use multi-environment config in every single configuration file in your `config/` folder.

To setup this mailer only for dev-environment, you can change `config/app.php` in a multi-environment config and configure the sSMTP mailer for dev only.

```php
return [
    // general for every environment
    '*' => [
        'modules' => [
            // ...
        ],
        'bootstrap' => [
            // ...
        ],
    ],

    // Staging environment settings
    'staging' => [
        // ...
    ],

    // Dev environment settings
    'dev' => [
        'components' => [
            'mailer' => function() {
                // Get the stored email settings
                $settings = Craft::$app->getSystemSettings()->getEmailSettings();
                $settings->transportType = bertoost\ssmtpmailer\mail\Ssmtp::class;
                $settings->transportSettings = [];

                return craft\helpers\MailerHelper::createMailer($settings);
            },
        ],
    ],
];
```