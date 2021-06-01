<?php

namespace Oaparecido\Courier\Services;

use Aws\Credentials\CredentialsInterface;

class SESCredentials implements CredentialsInterface
{
    /**
     * Returns the AWS access key ID for this credentials object.
     *
     * @return string
     */
    public function getAccessKeyId()
    {
        return config('courier.mailers.ses.config.key');
    }

    /**
     * Returns the AWS secret access key for this credentials object.
     *
     * @return string
     */
    public function getSecretKey()
    {
        return config('courier.mailers.ses.config.secret');
    }

    /**
     * Get the associated security token if available
     *
     * @return string|null
     */
    public function getSecurityToken()
    {
    }

    /**
     * Get the UNIX timestamp in which the credentials will expire
     *
     * @return int|null
     */
    public function getExpiration()
    {
    }

    /**
     * Check if the credentials are expired
     *
     * @return bool
     */
    public function isExpired()
    {
    }

    /**
     * Converts the credentials to an associative array.
     *
     * @return array
     */
    public function toArray()
    {
    }
}
