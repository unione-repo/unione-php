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

### Send email:
```php
  $client = new Unione\UnioneClient('YOUR-API-KEY', 'YOUR-HOST-NAME');
  // Example for EU instance.
  $client = new Unione\UnioneClient('YOUR-API-KEY', 'us1.unione.io');

  $recipients = [
    [
      "email" => 'john@example.com',
      "substitutions" => [
        "to_name" => "John Smith"
      ],
    ],
    [
      "email" => 'liza@example.com',
      "substitutions" => [
        "to_name" => "Liza Frank"
      ],
    ]
  ];

  $body = [
    "html" => "<b>Test mail, {{to_name}}</b>",
    "plaintext" => "Hello, {{to_name}}",
    "amp" => "<!doctype html><html amp4email><head> <meta charset=\"utf-8\"><script async src=\"https://cdn.ampproject.org/v0.js\"></script> <style amp4email-boilerplate>body[visibility:hidden]</style></head><body> Hello, AMP4EMAIL world.</body></html>"
  ];

  // You can use email object can be used to prepare the message array.
  // But the email send method accepts an array, that can be composed without
  // SDK utils.
  $mail = new Unione\Model\Email($recipients, $body);
  $mail->setFromEmail('user@example.com');
  $mail->setSubject('test letter');
  $response = $client->emails()->send($mail->toArray());
```
See [API documentation](https://docs.unione.io/en/web-api-ref#email) for more details.

See [template engine documentation](https://docs.unione.io/en/simple-template-engine) for substitutions details.

### Send subscribe email:

```php
  $client = new Unione\UnioneClient('YOUR-API-KEY', 'YOUR-HOST-NAME');

  $params = [
    "from_email" => "john@example.com",
    "from_name" => "John Smith",
    "to_email" => "user@example.com"
  ];
  $response = $client->emails()->subscribe($params);
```
API [documentation](https://docs.unione.io/en/web-api-ref#email-subscribe).

### Set template:
```php
  $client = new Unione\UnioneClient('YOUR-API-KEY', 'YOUR-HOST-NAME');

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
  $response = $client->templates()->set($params);
```
API [documentation](https://docs.unione.io/en/web-api-ref#template).

### Get template:
```php
  $client = new Unione\UnioneClient('YOUR-API-KEY', 'YOUR-HOST-NAME');
  $response = $client->templates()->get('YOUR-TEMPLATE-ID');
```
API [documentation](https://docs.unione.io/en/web-api-ref#template-get).

### Get templates list:
```php
  $client = new Unione\UnioneClient('YOUR-API-KEY', 'YOUR-HOST-NAME');

  $params = [
    "limit" => 50,
    "offset" => 0
  ];
  $response = $client->templates()->list($params);
```
API [documentation](https://docs.unione.io/en/web-api-ref#template-list).

### Delete template:
```php
  $client = new Unione\UnioneClient('YOUR-API-KEY', 'YOUR-HOST-NAME');
  $response = $client->templates()->delete('YOUR-TEMPLATE-ID');
```
API [documentation](https://docs.unione.io/en/web-api-ref#template-delete).

### Set webhook:
```php
  $client = new Unione\UnioneClient('YOUR-API-KEY', 'YOUR-HOST-NAME');

  $params = [
    "url" => "https://yourhost.example.com/unione-webhook",
    "events" => [
      "email_status" => [
        "delivered",
        "opened",
        "clicked",
        "unsubscribed",
        "soft_bounced",
        "hard_bounced",
        "spam"
      ]
    ]
  ];
  $response = $client->webhooks()->set($params);
```
API [documentation](https://docs.unione.io/en/web-api-ref#webhook-set).

The specified URL will receive a request from Unione. See more information about request data in API [documentation](https://docs.unione.io/en/web-api-ref#callback-format).

This is how you can check the message integrity in your callback handler:

```php

$client = new Unione\UnioneClient('YOUR-API-KEY', 'YOUR-HOST-NAME');
// $body contains a callback request body.
if ($client->webhooks()->verify($body) === TRUE) {
  // The webhook is confirmed, result can be processed.
}
```

### Get webhook:
```php
  $client = new Unione\UnioneClient('YOUR-API-KEY', 'YOUR-HOST-NAME');
  $response = $client->webhooks()->get('YOUR-WEBHOOK-URL');
```
API [documentation](https://docs.unione.io/en/web-api-ref#webhook-get).

### Get list all or some webhooks:
```php
  $client = new Unione\UnioneClient('YOUR-API-KEY', 'YOUR-HOST-NAME');
  $response = $client->webhooks()->list();
```
API [documentation](https://docs.unione.io/en/web-api-ref#webhook-list).

### Delete webhook:
```php
  $client = new Unione\UnioneClient('YOUR-API-KEY', 'YOUR-HOST-NAME');
  $response = $client->webhooks()->delete('YOUR-WEBHOOK-URL');
```
API [documentation](https://docs.unione.io/en/web-api-ref#webhook-delete).

## Additional information

### Generic API method

For API methods, that are not implemented in SDK yet, you can use `UnioneClient::httpRequest()`.
Here is an example for "set" suppression method:

```php
  $client = new Unione\UnioneClient('YOUR-API-KEY', 'YOUR-HOST-NAME');
  $response = $client->httpRequest('suppression/set.json', ["email" => "user@example.com", "cause" => "unsubscribed"]);
```

### Set Guzzle HTTP client config

Unione client accepts an array with Guzzle configuration as a third argument.
When creating a client, you can pass some additional options (i.e. connect_timeout)
to apply this to all requests.

Here is a more advanced example of adding a history handler to save outcoming
requests and responses.

```php
  $container = [];
  $history = Middleware::history($container);
  $handlerStack = HandlerStack::create();
  $handlerStack->push($history);
  $config = ['handler' => $handlerStack];
  $client = new Unione\UnioneClient('YOUR-API-KEY', 'YOUR-HOST-NAME', $config);
```

See [Guzzle documentation](https://docs.guzzlephp.org/en/stable/request-options.html).
