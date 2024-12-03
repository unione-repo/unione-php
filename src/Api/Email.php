<?php

declare(strict_types=1);

namespace Unione\Api;

use GuzzleHttp\Exception\GuzzleException;
use Unione\UnioneClient;
use Webmozart\Assert\Assert;

/**
 *  This class for sending  Mail.
 */
class Email
{
    /**
     * The UnioneClient client.
     *
     * @var UnioneClient
     */
    private UnioneClient $client;

    /**
     * @param UnioneClient $client
     */
    public function __construct(UnioneClient $client)
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
   * @param  array           $headers custom request headers
   * @return array           API response
   * @throws GuzzleException
   * @see  https://docs.unione.io/en/web-api-ref#email-send
   */
  public function send(array $params, array $headers = []): array
  {
      $headers_to_normalise = ['to', 'cc', 'bcc'];
      foreach ($headers as $key => $header) {
        $test = \strtolower($key);
        if (\in_array($test, $headers_to_normalise, TRUE)) {
          if ($test !== $key) {
            $headers[$test] = $headers[$key];
            unset($headers[$key]);
          }
        }
      }

      $recipients = [];
      // Prepare to remove duplicates if any.
      if (\is_array($params['recipients'])) {
        foreach ($params['recipients'] as $item) {
          $recipients[$item['email']] = $item;
        }
      }
      foreach ($headers_to_normalise as $key) {
        if (isset($headers[$key])) {
          foreach (\explode(',', $headers[$key]) as $item) {
            $trimmed = \trim($item);
            $recipients[$trimmed] = ['email' => $trimmed];
          }
        }
      }
      $params['recipients'] = \array_values($recipients);

      if (!empty($params['message'])) {
          $params = $params['message'];
      }

      Assert::isArray($params['recipients'], 'The recipients params must be an array. Got: %s');
      if (empty($params['template_id'])) {
          Assert::isArray($params['body'], 'The body params must be an array. Got: %s');
          Assert::string($params['subject'], 'The subject must be a string. Got: %s');
          Assert::email($params['from_email'], 'The from_email must be an email. Got: %s');
      }

      foreach ($params['recipients'] as $item) {
          Assert::email($item['email'], 'Recipient should be an array with "email" key containing a valid email address.. Got: %s');
      }

      if (isset($headers['to'])) {
        Assert::email($headers['to'], 'The TO header must be an email. Got: %s');
      }

      // Add the CC and BCC headers support.
      if (isset($headers['cc'])) {
        Assert::email($headers['cc'], 'The CC header must be an email. Got: %s');
      }
      if (isset($headers['bcc'])) {
        Assert::email($headers['bcc'], 'The BCC header must be an email. Got: %s');
      }
      // Enable strict mode according to https://docs.unione.io/en/cc-and-bcc .
      if (isset($headers['cc']) || isset($headers['bcc'])) {
        $headers['X-UNIONE'] = 'strict=true';
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
   * @return array           API response
   * @throws GuzzleException
   * @see https://docs.unione.io/en/web-api-ref#email-subscribe
   */
  public function subscribe(array $params): array
  {
      Assert::email($params['from_email'], 'The from_email must be an email. Got: %s');
      Assert::string($params['from_name'], 'The from_name must be a string. Got: %s');
      Assert::email($params['to_email'], 'The to_email must be an email. Got: %s');

      return $this->client->httpRequest('email/subscribe.json', $params);
  }
}
