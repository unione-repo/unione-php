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
final class UniOneClient
{
    /**
     * The current version of the SDK.
     */
    private const VERSION = '1.0.0';

    /**
     * The HTTP client.
     *
     * @var Client
     */
    private Client $httpClient;

    /**
     * UniOne Instance.
     *
     * @var string|UriInterface
     */
    private $endpoint = 'https://eu1.unione.io/en/transactional/api/v1/';

    /**
     * The API key.
     *
     * @var string
     */
    private string $apiKey;

    /**
     * @param string $endpoint
     * @param string $apiKey
     * @param array  $config
     */
    public function __construct(string $endpoint, string $apiKey, array $config = [])
    {
        $this->setEndpoint($endpoint)->setApiKey($apiKey);
        $defaults = [
          'timeout' => 5,
          'base_uri' => $this->endpoint,
        ];
        $client = new Client(\array_merge($defaults, $config));
        $this->setHttpClient($client);
    }

    /**
     * Set the API key.
     *
     * @param string $apiKey the API key
     */
    public function setApiKey(string $apiKey): UniOneClient
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @param string $endpoint
     *
     * @return void
     */
    public function setEndpoint(string $endpoint): UniOneClient
    {
        if (!empty($endpoint)) {
            $this->endpoint = $endpoint;
        }

        return $this;
    }

    /**
     * Create a new instance of the client.
     *
     * @param  ClientInterface $client
     * @return $this
     */
    public function setHttpClient(ClientInterface $client): UniOneClient
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
