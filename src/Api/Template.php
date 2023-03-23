<?php

declare(strict_types=1);

namespace Unione\Api;

use GuzzleHttp\Exception\GuzzleException;
use Unione\UniOneClient;

/**
 *  This class for sending  Template.
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
   * @param  array{template: array{'name': string, body: array{'html': string, 'plaintext': string, 'amp': string}, 'subject': string, 'from_email': string, 'from_name': string}} $template
   * @return array
   * @throws GuzzleException
   */
  public function set(array $template): array
  {
      return $this->client->httpRequest('template/set.json', $template);
  }

  /**
   * Get Template by id.
   * @param  string          $id
   * @return array
   * @throws GuzzleException
   */
  public function get(string $id): array
  {
      $params = [
        'id' => $id,
      ];

      return $this->client->httpRequest('template/get.json', $params);
  }

  /**
   * Get all Templates.
   * @param  array{'limit': int, 'offset': int} $params
   * @return array
   * @throws GuzzleException
   */
  public function list(array $params): array
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
      $body = [
        'id' => $id,
      ];

      return $this->client->httpRequest('template/delete.json', $body);
  }
}
