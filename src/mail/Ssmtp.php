<?php

namespace bertoost\ssmtpmailer\mail;

use Craft;
use craft\mail\transportadapters\BaseTransportAdapter;

/**
 * Class SsmtpTransport
 */
class Ssmtp extends BaseTransportAdapter
{
    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return 'sSMTP Mailer';
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml()
    {
        return Craft::$app->getView()->renderTemplate('ssmtpmailer/settings', [
            'adapter' => $this
        ]);
    }

    /**
     * @inheritdoc
     */
    public function defineTransport()
    {
        return [
            'class' => \Swift_SendmailTransport::class,
            'command' => '/usr/sbin/ssmtp -t',
        ];
    }
}
