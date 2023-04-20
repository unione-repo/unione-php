<?php

declare(strict_types=1);

$parameters = [
  'email' => [
    'send' => [
      'recipients' => [
        [
          'email' => 'user@example.com',
        ],
      ],
      'body' => [
        'html' => 'It is Unione send mail Test',
      ],
      'subject' => 'Unione Test Mail',
      'from_email' => 'user@example.com',
      'from_name' => 'Unione',
    ],
  ],

  'webhook' => [
    'set' => [
      'url' => 'https://yourhost.example.com/unione-webhook',
      'events' => [
        'email_status' => [
          'delivered',
          'opened',
          'clicked',
          'unsubscribed',
          'soft_bounced',
          'hard_bounced',
          'spam',
        ],
      ],
    ],
  ],
];

return $parameters;
