<?php

declare(strict_types=1);

namespace Unione\Api;

use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\TransferException;
use Unione\Model\Email as EmailData;
use Unione\UniOneClient;
use Webmozart\Assert\Assert;
use Webmozart\Assert\InvalidArgumentException;

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
   * @param  array                    $body the request body containing the necessary keys
   *                                        $body = [
   *                                        "from_email" => "user@example.com",
   *                                        "from_name" => "string",
   *                                        "to_email" => "user@example.com"
   *                                        ];
   * @return array                    the response with the status code
   * @throws GuzzleException
   * @throws BadResponseException
   * @throws TransferException
   * @throws InvalidArgumentException
   */
  public function subscribe(array $body): array
  {
      $path = 'email/subscribe.json';

      Assert::email($body['from_email'], 'The from_email must be an email. Got: %s');
      Assert::string($body['from_name'], 'The from_name must be an string. Got: %s');
      Assert::email($body['to_email'], 'The to_email must be an email. Got: %s');

      return $this->client->httpRequest($path, $body);
  }
}
