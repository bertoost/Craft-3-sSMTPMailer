# Craft CMS 3 - sSMTP Mailer

This mailer for Craft CMS 3 is a simple replacement for Sendmail, using sSMTP.

More information about sSMTP [can be found here](https://wiki.archlinux.org/index.php/SSMTP)

## Executed command

The next command is used for sSMTP to send your email.

```
/usr/sbin/ssmtp -t
``` 

## Sendmail replacement

This adaptor is using the Swiftmailer Sendmail Transport literally. It is extending it and just replaces the command to execute.

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

                return craft\helpers\MailerHelper::createMailer($settings);
            },
        ],
    ],
];
```