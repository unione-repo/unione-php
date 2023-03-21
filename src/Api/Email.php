<?php

declare(strict_types=1);

namespace Unione\Api;

use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\TransferException;
use Unione\Model\Email as EmailData;
use Unione\UniOneClient;

/**
 *  This class for sending  Mail.
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
   * Send a request to the UniOne API.
   * @param  EmailData            $mail the request parameters
   * @return array                the response with the status code
   * @throws GuzzleException
   * @throws BadResponseException
   * @throws TransferException
   */
  public function send(EmailData $mail): array
  {
      $path = 'email/send.json';
      $headers = $mail->getRequestHeaders();
      $body = $mail->toArray();

      return $this->client->httpRequest($path, $body, $headers);
  }

  /**
   * Send a request to the UniOne API.
   * @param  array                $body the request body
   * @return array                the response with the status code
   * @throws GuzzleException
   * @throws BadResponseException
   * @throws TransferException
   */
  public function subscribe(array $body): array
  {
      $path = 'email/subscribe.json';

      return $this->client->httpRequest($path, $body);
  }
}
