<?php

declare(strict_types=1);

namespace Unione\Api;

use GuzzleHttp\Exception\GuzzleException;
use Unione\UniOneClient;
use Webmozart\Assert\Assert;

/**
 *  This class implements Template API methods.
 */
class Template
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
   * Set new Template.
   * @param array {
   *              'name': string,
   *              'from_email': string,
   *          } $template
   * @return array
   * @throws GuzzleException
   */
  public function set(array $params): array
  {
      if (!empty($params['template'])) {
          $params = $params['template'];
      }
      Assert::string($params['name'], 'The name params must be an string. Got: %s');
      Assert::string($params['from_email'], 'The from_email params must be an string. Got: %s');

      return $this->client->httpRequest('template/set.json', ['template' => $params]);
  }

  /**
   * Get Template by id.
   * @param  string          $id
   * @return array
   * @throws GuzzleException
   */
  public function get(string $id): array
  {
      return $this->client->httpRequest('template/get.json', ['id' => $id]);
  }

  /**
   * Get all Templates.
   * @param  array{'limit'?: int, 'offset'?: int} $params
   * @return array
   * @throws GuzzleException
   */
  public function list(array $params = []): array
  {
      return $this->client->httpRequest('template/list.json', $params);
  }

  /**
   * Delete Template by id.
   * @param  string          $id
   * @return array
   * @throws GuzzleException
   */
  public function delete(string $id): array
  {
      return $this->client->httpRequest('template/delete.json', ['id' => $id]);
  }
}
