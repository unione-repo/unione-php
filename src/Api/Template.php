<?php

declare(strict_types=1);

namespace Unione\Api;

use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\TransferException;
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
   * @param  array                $template
   * @return array
   * @throws GuzzleException
   * @throws BadResponseException
   * @throws TransferException
   */
  public function set(array $template): array
  {
      $path = 'template/set.json';

      return $this->client->httpRequest($path, $template);
  }

  /**
   * Get Template by id.
   * @param  string               $id
   * @return array
   * @throws GuzzleException
   * @throws BadResponseException
   * @throws TransferException
   */
  public function get(string $id): array
  {
      $path = 'template/get.json';
      $body = [
        'id' => $id,
      ];

      return $this->client->httpRequest($path, $body);
  }

  /**
   * Get all Templates.
   * @param  array                $params
   * @return array
   * @throws GuzzleException
   * @throws BadResponseException
   * @throws TransferException
   */
  public function list(array $params): array
  {
      $path = 'template/list.json';

      return $this->client->httpRequest($path, $params);
  }

  /**
   * Delete Template by id.
   * @param  string               $id
   * @return array
   * @throws GuzzleException
   * @throws BadResponseException
   * @throws TransferException
   */
  public function delete(string $id): array
  {
      $path = 'template/delete.json';
      $body = [
        'id' => $id,
      ];

      return $this->client->httpRequest($path, $body);
  }
}
