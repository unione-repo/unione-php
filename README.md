# UniOne PHP client

[![Latest Stable Version](http://poser.pugx.org/unione/unione-php/v)](https://packagist.org/packages/unione/unione-php)
[![Total Downloads](http://poser.pugx.org/unione/unione-php/downloads)](https://packagist.org/packages/unione/unione-php)

This SDK contains methods for easily interacting with the UniOne API: https://docs.unione.io/en/web-api-ref#web-api

## Installation

Use Composer to install the package:

```bash
composer require unione/unione-php
```

## Usage

### Send an email:
API [documentation](https://docs.unione.io/en/web-api-ref#email).

```php
  use Unione\UniOneClient;

  $recipients = ['example@example.com', 'another@example.com'];

  $body = [
    "html" => "<b>Test mail, {{to_name}}</b>",
    "plaintext" => "Hello, {{to_name}}",
    "amp" => "<!doctype html><html amp4email><head> <meta charset=\"utf-8\"><script async src=\"https://cdn.ampproject.org/v0.js\"></script> <style amp4email-boilerplate>body[visibility:hidden]</style></head><body> Hello, AMP4EMAIL world.</body></html>"
  ];

  $mail = new Email($recipients, $body);
  $mail->setFromEmail('test@unione.io');

  // https://us1.unione.io/en/transactional/api/v1/ - UniOne USA & Canada Instance
  // https://eu1.unione.io/en/transactional/api/v1/ - UniOne European Instance
  // First, instantiate the client with your API credentials.
  $client = new UniOneClient('https://eu1.unione.io/en/transactional/api/v1/', 'api-key');

  // Now, compose and send your email.
  $response = $client->emails()->send($mail);
```

### Send a subscribe email:
API [documentation](https://docs.unione.io/en/web-api-ref#email-subscribe).

```php
  $params = [
    "from_email" => "test@unione.io",
    "from_name" => "string",
    "to_email" => "test@example.com"
  ];

  // Now, send your subscribe email.
  $response = $client->emails()->subscribe($params);
```

### Set a template:
API [documentation](https://docs.unione.io/en/web-api-ref#template).
```php
  $params = [
    "template" => [
      "name" => "First template",
      "body" => [
        "html" => "<b>Hello, {{to_name}}</b>",
        "plaintext" => "Hello, {{to_name}}",
        "amp" => "<!doctype html><html amp4email><head> <meta charset=\"utf-8\"><script async src=\"https://cdn.ampproject.org/v0.js\"></script> <style amp4email-boilerplate>body[visibility:hidden]</style></head><body> Hello, AMP4EMAIL world.</body></html>"
      ],
      "subject" => "Test template mail",
      "from_email" => "test@example.com",
      "from_name" => "Example From",
    ]
  ];

  // Now, set your template.
  $response = $client->templates()->set($params);
```

### Get template:
API [documentation](https://docs.unione.io/en/web-api-ref#template-get).
```php
  // Now, get your template.
  $response = $client->templates()->get('template-id');
```

### Get templates list:
API [documentation](https://docs.unione.io/en/web-api-ref#template-list).
```php
  // The query params
  $params = [
    "limit" => 50,
    "offset" => 0
  ];

  // Now, get list your templates.
  $response = $client->templates()->list($params);
```

### Delete template:
API [documentation](https://docs.unione.io/en/web-api-ref#template-delete).
```php
  // Now, remove your template.
  $response = $client->templates()->delete('template-id');
```

## UniOneClient methods

```php
  /**
  * @param string $endpoint
  * @param string $apiKey
  * @param array  $config the HTTP Client config
  */
  $client = new UniOneClient('https://eu1.unione.io/en/transactional/api/v1/', 'api-key', $config = []);

  /**
  * @return Api\Email the Api\Email instance
  */
  $client->emails();

  /**
  * @return Api\Template the Api\Template instance
  */
  $client->templates();
```
### Debug requests and responses to the server:
API [documentation](https://docs.guzzlephp.org/en/stable/testing.html#history-middleware).
```php
  $container = [];
  $history = Middleware::history($container);
  $handlerStack = HandlerStack::create();
  $handlerStack->push($history);
  $config = ['handler' => $handlerStack];
  $client = new UniOneClient('endpoint', 'api-key', $config);
```
