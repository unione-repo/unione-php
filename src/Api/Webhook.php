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
     *              'events': array
     *            } $params the request parameters
     *
     * @return array           API response
     * @throws GuzzleException
     * @see  https://docs.unione.io/en/web-api-ref#webhook-set
     */
    public function set(array $params): array
    {
        Assert::string($params['url'], 'The url must be a string. Got: %s');
        Assert::isNonEmptyList($params['events']['email_status'], 'The email_status must be a not empty array and should contain at least one of the events to subscribe. Got: %s');

        return $this->client->httpRequest('webhook/set.json', $params);
    }

  /**
   * Gets properties of a webhook.
   *
   * @param string $url the request parameter
   *
   * @return array           API response
   * @throws GuzzleException
   * @see  https://docs.unione.io/en/web-api-ref#webhook-get
   */
  public function get(string $url): array
  {
      Assert::string($url, 'The url must be a string. Got: %s');

      return $this->client->httpRequest('webhook/get.json', ['url' => $url]);
  }

  /**
   * List all or some webhooks.
   *
   * @param array $params the request parameters
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
   * Deletes a webhook.
   *
   * @param string $url URL of webhook that be removed
   *
   * @return array           API response
   * @throws GuzzleException
   * @see  https://docs.unione.io/en/web-api-ref#webhook-delete
   */
  public function delete(string $url): array
  {
      Assert::string($url, 'The url must be a string. Got: %s');

      return $this->client->httpRequest('webhook/delete.json', ['url' => $url]);
  }

  /**
   * Verify webhook request message integrity.
   *
   * @param string $body webhook request body
   *
   * @return bool
   */
  public function verify(string $body): bool
  {
      if (empty($body)) {
          return false;
      }

      // Body "auth" array key contains MD5-hash of the whole message, in which
      // the value “auth” contained API key of the user/project.
      // In order to check the integrity, we should set the API key as "auth"
      // parameter and verify it with original "auth" value.
      // See: https://docs.unione.io/en/web-api-ref#callback-format
      $params = \json_decode($body, true);
      $auth = $params['auth'];
      $params['auth'] = $this->client->getApiKey();
      $md5_body = \md5(\json_encode($params));

      return $auth === $md5_body;
  }
}
