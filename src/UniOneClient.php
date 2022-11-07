<?php

declare(strict_types=1);

namespace Unione;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Psr\Http\Message\UriInterface;

/**
 * This class is the base class for the UniOne SDK.
 */
final class UniOneClient {

  /**
   * The HTTP client.
   *
   * @var Client
   */
  protected Client $httpClient;

  /**
   * UniOne Instance.
   *
   * @var string|UriInterface
   * @todo: Make it configurable.
   */
  static protected $endpoint = 'https://eu1.unione.io/en/transactional/api/v1/';

  /**
   * The API key.
   *
   * @var string
   */
  protected string $apiKey;

  public function __construct() {
    $this->httpClient = new Client([
      'base_uri' => $this::$endpoint
    ]);
  }

  /**
   * Set the API key.
   *
   * @param string $apiKey The API key.
   */
  public function setApiKey(string $apiKey): void {
    $this->apiKey = $apiKey;
  }

  /**
   * Send a request to the UniOne API.
   *
   * @param array $body The request body.
   * @param array $head The request headers.
   *
   * @return string
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  public function sender(array $body, array $head = []): string {
    $responseHeader = [
      'Content-Type' => 'application/json',
      'Accept' => 'application/json',
      'X-API-KEY' => $this->apiKey,
      'X-Mailer' => 'UniOne SDK-PHP agent'
    ];

    // Build body for request.
    // @todo: Refactor this and create a special class for it.
    $responseBody = [
      "message" => [
        "recipients" => [
          [
            "email" => $body['recipients_email'] ?? NULL,
            "substitutions" => $body['recipients_substitutions'] ?? NULL,
            "metadata" => $body['recipients_metadata'] ?? NULL,
          ]
        ],
        "template_id" => $body['template_id'] ?? NULL,
        "skip_unsubscribe" => $body['skip_unsubscribe'] ?? NULL,
        "global_language" => $body['global_language'] ?? NULL,
        "template_engine" => $body['template_engine'] ?? NULL,
        "global_substitutions" => $body['global_substitutions'] ?? NULL,
        "global_metadata" => $body['global_metadata'] ?? NULL,
        "body" => [
          "html" => $body['body_html'] ?? NULL,
          "plaintext" => $body['body_plaintext'] ?? NULL,
          "amp" => $body['body_amp'] ?? NULL,
        ],
        "subject" => $body['subject'] ?? NULL,
        "from_email" => $body['from_email'] ?? NULL,
        "from_name" => $body['from_name'] ?? NULL,
        "reply_to" => $body['reply_to'] ?? NULL,
        "track_links" => 0,
        "track_read" => 0,
        "headers" => $body['headers'] ?? NULL,
        "attachments" => $body['attachments'] ?? NULL,
        "inline_attachments" => $body['inline_attachments'] ?? NULL,
        "options" => $body['options'] ?? NULL,
      ]
    ];

    try {
      // Send request.
      $response = $this->httpClient->post('email/send.json', [
          'headers' => $head + $responseHeader,
          'json' => $responseBody
        ]
      );

      return $response->getBody()->getContents();
    } catch (BadResponseException $e) {
      // handle exception or api errors.
      return $e->getResponse()->getBody()->getContents();
    }
  }

}