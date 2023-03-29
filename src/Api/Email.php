<?php

declare(strict_types=1);

namespace Unione\Api;

use GuzzleHttp\Exception\GuzzleException;
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
   *
   * @param array {
   *                'recipients': array {array {'email': string}},
   *                'body': array,
   *                'subject': string,
   *                'from_email': string,
   *             } $params the request parameters
   * @param array $headers the request headers
   *
   * @return array           the response with the status code
   * @throws GuzzleException
   * @see  https://docs.unione.io/en/web-api-ref#email-send Documentation of unione email-send
   */
  public function send(array $params, array $headers = []): array
  {
      if (!empty($params['message'])) {
          $params = $params['message'];
      }

      Assert::isArray($params['recipients'], 'The recipients params must be an array. Got: %s');
      Assert::isArray($params['body'], 'The body params must be an array. Got: %s');
      Assert::string($params['subject'], 'The subject must be a string. Got: %s');
      Assert::email($params['from_email'], 'The from_email must be an email. Got: %s');

      if (!empty($params['recipients'])) {
          foreach ($params['recipients'] as $item) {
              Assert::email($item['email'], 'The email must be an email. Got: %s');
          }
      }

      return $this->client->httpRequest('email/send.json', ['message' => $params], $headers);
  }

  /**
   * Send a subscription email.
   *
   * @param array {
   *              'from_email': string,
   *              'from_name': string,
   *              'to_email': string,
   *           } $params the request body containing the necessary keys
   * @return array           the response with the status code
   * @throws GuzzleException
   * @see https://docs.unione.io/en/web-api-ref#email-subscribe Documentation of unione email-subscribe.
   */
  public function subscribe(array $params): array
  {
      Assert::email($params['from_email'], 'The from_email must be an email. Got: %s');
      Assert::string($params['from_name'], 'The from_name must be a string. Got: %s');
      Assert::email($params['to_email'], 'The to_email must be an email. Got: %s');

      return $this->client->httpRequest('email/subscribe.json', $params);
  }
}
