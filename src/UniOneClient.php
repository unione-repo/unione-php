<?php

declare(strict_types=1);

namespace Unione;

use GuzzleHttp\Client;
use Psr\Http\Message\UriInterface;

/**
 * This class is the base class for the UniOne SDK.
 */
final class UniOneClient
{
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
     * The timeout in seconds.
     *
     * @var float
     */
    private float $timeout;

    /**
     * @param string $endpoint
     * @param string $apiKey
     */
    public function __construct(string $endpoint, string $apiKey)
    {
        $this->setApiKey($apiKey);
        $this->setEndpoint($endpoint);
        $this->setHttpClient();
        $this->setTimeout(5);
    }

    /**
     * Set the API key.
     *
     * @param string $apiKey the API key
     */
    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Set the timeout in seconds.
     *
     * @param float $timeout the timeout in seconds
     */
    public function setTimeout(float $timeout): void
    {
        $this->timeout = $timeout;
    }

    /**
     * @param string $endpoint
     *
     * @return void
     */
    public function setEndpoint(string $endpoint): void
    {
        if (!empty($endpoint)) {
            $this->endpoint = $endpoint;
        }
    }

    /**
     * Create a new instance of the client.
     *
     * @return void
     */
    public function setHttpClient(): void
    {
        $this->httpClient = new Client([
          'base_uri' => $this->endpoint,
        ]);
    }

    /**
     * Send a request to the UniOne API.
     *
     * @param array $body    the request body
     * @param array $headers the request headers
     *
     * @return string the response with the status code
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \GuzzleHttp\Exception\BadResponseException
     * @throws \GuzzleHttp\Exception\TransferException
     */
    public function send(array $body, array $headers = []): string
    {
        $requestHeaders = $headers + [
          'Content-Type' => 'application/json',
          'Accept' => 'application/json',
          'X-API-KEY' => $this->apiKey,
          'X-Mailer' => 'UniOne PHP-SDK',
        ];

        // Build body for request.
        // @todo: Refactor this and create a special class for it.
        $requestBody = [
          'message' => [
            'recipients' => $body['recipients'],
            'template_id' => $body['template_id'] ?? null,
            'skip_unsubscribe' => $body['skip_unsubscribe'] ?? null,
            'global_language' => $body['global_language'] ?? null,
            'template_engine' => $body['template_engine'] ?? null,
            'global_substitutions' => $body['global_substitutions'] ?? null,
            'global_metadata' => $body['global_metadata'] ?? null,
            'body' => [
              'html' => $body['body_html'] ?? null,
              'plaintext' => $body['body_plaintext'] ?? null,
              'amp' => $body['body_amp'] ?? null,
            ],
            'subject' => $body['subject'] ?? null,
            'from_email' => $body['from_email'] ?? null,
            'from_name' => $body['from_name'] ?? null,
            'reply_to' => $body['reply_to'] ?? null,
            'track_links' => 0,
            'track_read' => 0,
            'headers' => $body['headers'] ?? null,
            'attachments' => $body['attachments'] ?? null,
            'inline_attachments' => $body['inline_attachments'] ?? null,
            'options' => $body['options'] ?? null,
          ],
        ];

        try {
            // Send request.
            $response = $this->httpClient->post('email/send.json', [
                'headers' => $requestHeaders,
                'json' => $requestBody,
                'timeout' => $this->timeout,
              ]
            );

            return $response->getBody()->getContents();
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            // handle exception or api errors.
            return $e->getResponse()->getBody()->getContents();
        } catch (\GuzzleHttp\Exception\TransferException $e) {
            // handle exception or api errors.
            return $e->getMessage();
        }
    }
}
