<?php

declare(strict_types=1);

namespace Unione\Api;

use Unione\Model\Email as EmailData;
use Unione\UniOneClient;

/**
 * This class for sending  Mail.
 */
class Email
{
    /**
     * The Url path.
     */
    private string $path = 'email/send.json';

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
     * Send a request to the UniOne API.
     *
     * @param Email $mail the request parameters
     *
     * @return string the response with the status code
     */
    public function send(EmailData $mail): string
    {
        $headers = $mail->getRequestHeaders();
        $body = $mail->toArray();

        return $this->client->httpRequest($this->path, $body, $headers);
    }
}
