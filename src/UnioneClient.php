<?php

declare(strict_types=1);

namespace Unione;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\TransferException;
use Psr\Http\Message\UriInterface;

/**
 * This class is the base class for the UniOne SDK.
 */
final class UnioneClient
{
    /**
     * The current version of the SDK.
     */
    private const VERSION = '1.2.0';

    /**
     * The HTTP client.
     *
     * @var ClientInterface
     */
    private ClientInterface $httpClient;

    /**
     * UniOne Instance.
     *
     * @var string|UriInterface
     */
    private $endpoint;

    /**
     * The API key.
     *
     * @var string
     */
    private string $apiKey;

    /**
     * @param string $apiKey
     * @param string $endpoint
     * @param array  $config
     */
    public function __construct(string $apiKey, string $endpoint, array $config = [])
    {
        $this->setApiKey($apiKey);

        $this->setEndpoint($endpoint);

        $config = [
            'timeout' => 5,
            'base_uri' => $this->endpoint,
          ] + $config;
        $client = new Client($config);
        $this->setHttpClient($client);
    }

    /**
     * Set the API key.
     *
     * @param  string $apiKey the API key
     * @return $this
     */
    public function setApiKey(string $apiKey): UnioneClient
    {
        $this->apiKey = $apiKey;

        return $this;
    }

  /**
   * Get the API key.
   *
   * @return string
   */
  public function getApiKey(): string
  {
      return $this->apiKey;
  }

    /**
     * Set the endpoint.
     *
     * @param  string $host
     * @return $this
     */
    public function setEndpoint(string $host): UnioneClient
    {
        $this->endpoint = "https://{$host}/en/transactional/api/v1/";

        return $this;
    }

    /**
     * Create a new instance of the client.
     *
     * @param  ClientInterface $client
     * @return $this
     */
    public function setHttpClient(ClientInterface $client): UnioneClient
    {
        $this->httpClient = $client;

        return $this;
    }

    /**
     * @return Api\Email
     */
    public function emails(): Api\Email
    {
        return new Api\Email($this);
    }

    /**
     * @return Api\Template
     */
    public function templates(): Api\Template
    {
        return new Api\Template($this);
    }

  /**
   * @return Api\Webhook
   */
  public function webhooks(): Api\Webhook
  {
      return new Api\Webhook($this);
  }

    /**
     * @param  string               $path
     * @param  array                $body
     * @param  array                $headers
     * @param  string               $method
     * @return array
     * @throws GuzzleException
     * @throws BadResponseException
     * @throws TransferException
     */
    public function httpRequest(string $path, array $body, array $headers = [], string $method = 'POST'): array
    {
        $requestHeaders = $headers + [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'X-API-KEY' => $this->apiKey,
            'X-Mailer' => 'phpsdk-unione',
          ];

        // Send request.
        $response = $this->httpClient->request($method, $path, [
          'headers' => $requestHeaders,
          'json' => $body,
          'query' => ['platform' => 'phpsdk.'.self::VERSION],
        ]);

        return \json_decode($response->getBody()->getContents(), true);
    }
}
