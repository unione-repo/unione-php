<?php

declare(strict_types=1);

namespace Unione\Api;

use GuzzleHttp\Exception\GuzzleException;
use Unione\Model\Email as EmailData;
use Unione\UniOneClient;
use Webmozart\Assert\Assert;

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
   * Send an email.
   * @param  EmailData       $mail the request parameters
   * @return array           the response with the status code
   * @throws GuzzleException
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
   * @param  array{'from_email': string, 'from_name': string, 'to_email': string} $params the request body containing the necessary keys
   * @return array                                                                the response with the status code
   * @throws GuzzleException
   */
  public function subscribe(array $params): array
  {
      Assert::email($params['from_email'], 'The from_email must be an email. Got: %s');
      Assert::string($params['from_name'], 'The from_name must be an string. Got: %s');
      Assert::email($params['to_email'], 'The to_email must be an email. Got: %s');

      return $this->client->httpRequest('email/subscribe.json', $params);
  }
}
