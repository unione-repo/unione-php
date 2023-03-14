<?php

declare(strict_types=1);

namespace Unione;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

/**
 * This class is the base class for the UniOne SDK.
 */
final class UniOneClient
{
    /**
     * The current version of the SDK.
     */
    private const VERSION = '0.0';

    /**
     * Te debug mode.
     */
    private bool $debugMode = false;

    /**
     * Request data.
     */
    private HandlerStack $requestStack;
    /**
     * The debug Log.
     */
    private array $logData = [];

    /**
     * The HTTP client.
     *
     * @var Client
     */
    private Client $httpClient;

    /**
     * UniOne Instance.
     * @var string|UriInterface
     */
    private string $endpoint = 'https://eu1.unione.io/en/transactional/api/v1/';

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
            'handler' => $this->debugMode ? $this->requestStack : null,
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
     * @return $this
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
     * @param  string               $path
     * @param  array                $body
     * @param  array                $headers
     * @param  string               $method
     * @return string
     * @throws GuzzleException
     * @throws BadResponseException
     * @throws TransferException
     */
    public function httpRequest(string $path, array $body, array $headers = [], string $method = 'POST'): string
    {
        $requestHeaders = $headers + [
          'Content-Type' => 'application/json',
          'Accept' => 'application/json',
          'X-API-KEY' => $this->apiKey,
          'X-Mailer' => 'phpsdk-unione',
        ];

        if (!isset($body['message']['platform'])) {
            $requestBody['message']['platform'] = 'phpsdk.'.self::VERSION;
        }

        try {
            // Send request.
            $response = $this->httpClient->request($method, $path, [
            'headers' => $requestHeaders,
            'json' => $requestBody,
            ]);

            $responseData = $response->getBody();

            if ($this->debugMode) {
                $this->logData['response'] = $responseData;
            }

            return $responseData->getContents();
        } catch (BadResponseException $e) {
            // handle exception or api errors.
            $responseData = $response->getBody();

            if ($this->debugMode) {
                $this->logData['response'] = $responseData;
            }

            return $responseData->getContents();
        } catch (TransferException $e) {
            // handle exception or api errors.
            return $e->getMessage();
        }
    }

    /**
     * @return Api\Email
     */
    public function emails(): Api\Email
    {
        return new Api\Email($this);
    }

    /**
     * Set debug mode.
     * @param  bool $mode
     * @return void
     */
    public function setDebug(bool $mode = true)
    {
        $this->debugMode = $mode;

        if ($this->debugMode) {
            $this->requestStack = HandlerStack::create();
            // Middleware that keeps Request data.
            $this->requestStack->push(Middleware::mapRequest(function (RequestInterface $request): RequestInterface {
                $contentsRequest = (string) $request->getBody();
                $this->logData['request'] = $contentsRequest;

                return $request;
            }));
        }
    }

    /**
     * Return debug log array, if debugMode false return empty array.
     * @return array|null
     */
    public function getLog(): ?array
    {
        return $this->logData;
    }
}
