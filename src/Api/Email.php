<?php

declare(strict_types=1);

namespace Unione\Api;

use Unione\Model\Email as EmailData;
use Unione\UniOneClient;

/**
 *  Class for Email API methods.
 */
class Email
{
    /**
     * The UniOneClient client.
     *
     * @var UniOneClient
     */
    private UniOneClient $client;

    /**
     * @param UniOneClient $client
     */
    public function __construct(UniOneClient $client)
    {
        $this->client = $client;
    }

    /**
     * Sends an email.
     *
     * @param Email $mail the request parameters
     *
     * @return string the response with the status code
     */
    public function send(EmailData $mail): string
    {
        $path = 'email/send.json';
        $headers = $mail->getRequestHeaders();
        $body = $mail->toArray();

        return $this->client->httpRequest($path, $body, $headers);
    }
}
