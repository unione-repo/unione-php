<?php

declare(strict_types=1);

namespace Unione\Api;

use GuzzleHttp\Exception\GuzzleException;
use Unione\UnioneClient;
use Webmozart\Assert\Assert;

/**
 *  This class for sending  Webhook.
 */
class Webhook
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
     * Sets or edits a webhook.
     *
     * @param array {
     *              'url': string
     *              'events': array {'email_status': array}
     *            } $params the request parameters
     *
     * @return array           API response
     * @throws GuzzleException
     * @see  https://docs.unione.io/en/web-api-ref#webhook-set
     */
    public function set(array $params): array
    {
        Assert::string($params['url'], 'The url must be a string. Got: %s');
        Assert::isNonEmptyList($params['events']['email_status'], 'The email_status must be a not empty array. Got: %s');
        return $this->client->httpRequest('webhook/set.json', $params);
    }

  /**
   * Gets properties of a webhook.
   *
   * @param array {'url': string} $params the request parameters
   *
   * @return array           API response
   * @throws GuzzleException
   * @see  https://docs.unione.io/en/web-api-ref#webhook-get
   */
  public function get(array $params): array
  {
      Assert::string($params['url'], 'The url must be a string. Got: %s');

      return $this->client->httpRequest('webhook/get.json', $params);
  }

  /**
   * List all or some webhook.
   *
   * @return array           API response
   * @throws GuzzleException
   * @see  https://docs.unione.io/en/web-api-ref#webhook-list
   */
  public function list(array $params = []): array
  {
      return $this->client->httpRequest('webhook/list.json', $params);
  }

  /**
   * Deletes an event notification handler.
   *
   * @param array {'url': string} $params the request parameters
   *
   * @return array           API response
   * @throws GuzzleException
   * @see  https://docs.unione.io/en/web-api-ref#webhook-delete
   */
  public function delete(array $params): array
  {
      Assert::string($params['url'], 'The url must be a string. Got: %s');

      return $this->client->httpRequest('webhook/delete.json', $params);
  }

  /**
   * Validate hook response message.
   *
   * @param string $message_body
   *
   * @return bool
   */
  public function validate(string $message_body): bool
  {
      if (empty($message_body)) {
          return false;
      }

      $params = \json_decode($message_body, true);
      $auth = $params['auth'];
      $params['auth'] = $this->client->getApiKey();
      $md5_body = \md5(\json_encode($params));

      return $auth == $md5_body;
  }
}
