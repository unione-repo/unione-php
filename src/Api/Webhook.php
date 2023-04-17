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
     * @param array {'url': string} $params the request parameters
     *
     * @return array           API response
     * @throws GuzzleException
     * @see  https://docs.unione.io/en/web-api-ref#webhook-set
     */
    public function set(array $params): array
    {
        Assert::string($params['url'], 'The url must be a string. Got: %s');

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
}
