<?php

declare(strict_types=1);

namespace Unione\Api;

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

  public function send(array $template): string
  {
      $path = 'template/set.json';

      return $this->client->httpRequest($path, $template);
  }
}
