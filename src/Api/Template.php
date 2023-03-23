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
   * @param  array{template: array{'name': string, body: array{'html': string, 'plaintext': string, 'amp': string}, 'subject': string, 'from_email': string, 'from_name': string}} $template
   * @return array
   * @throws GuzzleException
   */
  public function set(array $params): array
  {
      Assert::isArray($$params['template'], 'The template params must be an array. Got: %s');
      Assert::string($$params['template']['name'], 'The template->name params must be an string. Got: %s');
      Assert::isArray($$params['template']['body'], 'The template->body params must be an array. Got: %s');
      Assert::string($$params['template']['body']['html'], 'The template->body->html params must be an string. Got: %s');
      Assert::string($$params['template']['body']['plaintext'], 'The template->body->plaintext params must be an string. Got: %s');
      Assert::string($$params['template']['body']['amp'], 'The template->body->amp params must be an string. Got: %s');
      Assert::string($$params['template']['subject'], 'The template->subject params must be an string. Got: %s');
      Assert::string($$params['template']['from_email'], 'The template->from_email params must be an string. Got: %s');
      Assert::string($$params['template']['from_name'], 'The template->from_name params must be an string. Got: %s');

      return $this->client->httpRequest('template/set.json', $params);
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
      Assert::integer($params['limit'], 'The limit params must be an integer. Got: %s');
      Assert::integer($params['offset'], 'The offset params must be an integer. Got: %s');

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
