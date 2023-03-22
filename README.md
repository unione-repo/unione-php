# UniOne PHP client

[![Latest Stable Version](http://poser.pugx.org/unione/unione-php/v)](https://packagist.org/packages/unione/unione-php)
[![Total Downloads](http://poser.pugx.org/unione/unione-php/downloads)](https://packagist.org/packages/unione/unione-php)

This is the UniOne PHP SDK. This SDK contains methods for easily interacting
with the UniOne API. For additional
examples, please see our official documentation at https://docs.unione.io/en/web-api-ref#web-api

# Installation

To install the SDK, you will need to be using [Composer](http://getcomposer.org/)
in your project.
If you aren't using Composer yet, it's really simple! Here's how to install
composer:

```bash
curl -sS https://getcomposer.org/installer | php
```

Use Composer to install the package:

```bash
composer require unione/unione-php
```

## Usage

### Here's how to send a message using the SDK:
More about the **UniOne** send mail API [https://docs.unione.io](https://docs.unione.io/en/web-api-ref#email).

```php
 $recipients = [
    ["email" => "example@example.com"]
  ];

  $body = [
    "html" => "<b>Test mail, {{to_name}}</b>",
    "plaintext" => "Hello, {{to_name}}",
    "amp" => "<!doctype html><html amp4email><head> <meta charset=\"utf-8\"><script async src=\"https://cdn.ampproject.org/v0.js\"></script> <style amp4email-boilerplate>body[visibility:hidden]</style></head><body> Hello, AMP4EMAIL world.</body></html>"
  ];

  $mail = new Email($recipients, $body);
  $mail->setFromEmail('test@example.com');

  // https://us1.unione.io/en/transactional/api/v1/ - UniOne USA & Canada Instance
  // https://eu1.unione.io/en/transactional/api/v1/ - UniOne European Instance
  // First, instantiate the SDK with your API credentials
  $client = new UniOneClient('https://eu1.unione.io/en/transactional/api/v1/', 'api-key');
  $mailer = $client->emails();

  // Now, compose and send your message.
  $response = $mailer->send($mail);
```

### Here's how to send a subscribe message using the SDK:
More about the **UniOne** send mail API [https://docs.unione.io](https://docs.unione.io/en/web-api-ref#email-subscribe).

```php
  $requestBody = [
  "from_email" => "test@example.com",
  "from_name" => "string",
  "to_email" => "test@example.com"
  ];

  $client = new UniOneClient('https://eu1.unione.io/en/transactional/api/v1/', 'api-key');
  $mailer = $client->emails();

  // Now, send your subscribe message.
  $response = $mailer->subscribe($requestBody);
```

### Here's how to set a template using the SDK:
More about the **UniOne** Template API [https://docs.unione.io](https://docs.unione.io/en/web-api-ref#template).
```php
  $requestBody = [
      "template" => [
        "name" => "First template",
        "body" => [
          "html" => "<b>Hello, {{to_name}}</b>",
          "plaintext" => "Hello, {{to_name}}",
          "amp" => "<!doctype html><html amp4email><head> <meta charset=\"utf-8\"><script async src=\"https://cdn.ampproject.org/v0.js\"></script> <style amp4email-boilerplate>body[visibility:hidden]</style></head><body> Hello, AMP4EMAIL world.</body></html>"
        ],
        "subject" => "Test template mail",
        "from_email" => "test@unione.devbranch.work",
        "from_name" => "Devbranch",
      ]
    ];

  $client = new UniOneClient('https://eu1.unione.io/en/transactional/api/v1/', 'api-key');
  $template = $client->templates();

   // Now, set your template.
   $response = $template->set($requestBody);
```

### Get template using the SDK:
More about the **UniOne** Template **get** method [https://docs.unione.io](https://docs.unione.io/en/web-api-ref#template-get).
```php
  $client = new UniOneClient('https://eu1.unione.io/en/transactional/api/v1/', 'api-key');
  $template = $client->templates();

   // Now, get your template.
   $response = $template->get('template-id');
```

### List templates using the SDK:

More about the **UniOne** Template **list** method [https://docs.unione.io](https://docs.unione.io/en/web-api-ref#template-list).
```php
  // The query params
  $params = [
  "limit" => 50,
  "offset" => 0
  ];

  $client = new UniOneClient('https://eu1.unione.io/en/transactional/api/v1/', 'api-key');
  $template = $client->templates();

   // Now, get list your templates.
   $response = $template->list($params);
```

### Delete template using the SDK:
More about the **UniOne** Template **delete** method [https://docs.unione.io](https://docs.unione.io/en/web-api-ref#template-delete).
```php
  $client = new UniOneClient('https://eu1.unione.io/en/transactional/api/v1/', 'api-key');
  $template = $client->templates();

   // Now, remove your template.
   $response = $template->delete('template-id');
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
  * Set the API key.
  * @param string $apiKey the API key
  * @return $this
  */
  $client->setApiKey(string $apiKey);

  /**
  * @param string $endpoint
  * @return $this
  */
  $client->setEndpoint(string $endpoint);

  /**
  * Create a new instance of the client.
  *
  * @param  ClientInterface $client
  * @return $this
  */
  $client->setHttpClient(ClientInterface $client);

  /**
  * @return Api\Email the Api\Email instance
  */
  $client->emails();

  /**
  * @return Api\Template the Api\Template instance
  */
  $client->templates();

  /**
  * @param  string $path
  * @param  array $body
  * @param  array $headers
  * @param  string $method
  * @return array
  * @throws GuzzleException
  * @throws BadResponseException
  * @throws TransferException
  */
  $client->httpRequest(string $path, array $body, array $headers = [], string $method = 'POST');
```
## Model\Emails methods

```php
  use Unione\Model\Email;

  /**
  * @param array $recipients
  * @param array $body
  */
  $email = new Email(array $recipients = [], array $body = []);

  /**
  * @return array the recipients emails
  */
  $email->getRecipients();


  /**
  * @param array $recipients
  * @return $this
  */
  $email->setRecipients(array $recipients);

  /**
  * @return string
  */
  $email->getTemplateId()

  /**
  * @param string $templateId
  * @return $this
  */
  $email->setTemplateId(string $templateId);

  /**
  * @return array
  */
  $email->getTags();

  /**
  * @param array $tags
  * @return $this
  */
  $email->setTags(array $tags);

  /**
  * @return int
  */
  $email->getSkipUnsubscribe()

  /**
  * @param int $skipUnsubscribe
  * @return $this
  */
  $email->setSkipUnsubscribe(int $skipUnsubscribe);

  /**
  * @return string
  */
  $email->getGlobalLanguage();

  /**
  * @param string $globalLanguage
  * @return $this
  */
  $email->setGlobalLanguage(string $globalLanguage);

  /**
  * @return string
  */
  $email->getTemplateEngine();

  /**
  * @param string $templateEngine
  * @return $this
  */
  $email->setTemplateEngine(string $templateEngine);

  /**
  * @return array
  */
  $email->getGlobalSubstitutions();

  /**
  * @param array $globalSubstitutions
  * @return $this
  */
  $email->setGlobalSubstitutions(array $globalSubstitutions);

  /**
  * @return array
  */
  $email->getGlobalMetadata();

   /**
   * @param array $globalMetadata
   * @return $this
   */
   $email->setGlobalMetadata(array $globalMetadata);

  /**
  * @return array
  */
  $email->getBody();

  /**
  * @param array $body
  * @return $this
  */
  $email->setBody(array $body);

  /**
  * @return string
  */
  $email->getSubject();

  /**
  * @param string $subject
  * @return $this
  */
  $email->setSubject(string $subject);

  /**
  * @return string
  */
  $email->getFromEmail();

  /**
  * @param string $fromEmail
  * @return $this
  */
  $email->setFromEmail(string $fromEmail);

  /**
  * @return string
  */
  $email->getFromName();

  /**
  * @param string $fromName
  * @return $this
  */
  $email->setFromName(string $fromName);

  /**
  * @return string
  */
  $email->getReplyTo();

  /**
  * @param string $replyTo
  * @return $this
  */
  $email->setReplyTo(string $replyTo);

  /**
  * @return int
  */
  $email->getTrackLinks();

  /**
  * @param int $trackLinks
  * @return $this
  */
  $email->setTrackLinks(int $trackLinks);

  /**
  * @return int
  */
  $email->getTrackRead();

  /**
  * @param int $trackRead
  * @return $this
  */
  $email->setTrackRead(int $trackRead);

  /**
  * @return array
  */
  $email->getHeaders();

  /**
  * @param array $headers
  * @return $this
  */
  $email->setHeaders(array $headers);

  /**
  * @return array
  */
  $email->getAttachments();

  /**
  * @param array $attachments
  * @return $this
  */
  $email->setAttachments(array $attachments);

  /**
  * @return array
  */
  $email->getInlineAttachments();

  /**
  * @param array $inlineAttachments
  * @return $this
  */
  $email->setInlineAttachments(array $inlineAttachments);

  /**
  * @return array
  */
  $email->getOptions();

  /**
  * @param array $options
  * @return $this
  */
  $email->setOptions(array $options);

  /**
  * @param string $platform
  * @return $this
  */
  $email->setPlatform(string $platform);

  /**
  * @return string
  */
  $email->getPlatform();

  /**
  * Method for build message array.
  * @return array[] The message array
  */
  $email->toArray();

  /**
  * Set message array
  * @param $message
  * @return Email
  */
  $email->fromArray($message);

  /**
  * Set message array message[$property] = $value
  * @param string $property
  * @param $value
  * @return $this
  */
  $email->set(string $property, $value);

  /**
  * @param array $requestHeaders
  * @return $this
  */
  $email->setRequestHeaders(array $requestHeaders);

  /**
  * @param string $key
  * @param string $value
  * @return $this
  */
  $email->setRequestHeader(string $key, string $value);

  /**
  * @return array
  */
  $email->getRequestHeaders();
```
