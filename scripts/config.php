<?php

declare(strict_types=1);

$parameters = [
  'email' => [
    'send' => [
      [
        'recipients' => [
          [
            'email' => 'user@example.com',
          ],
        ],
        'body' => [
          'html' => 'It is Unione send mail Test',
        ],
        'subject' => 'Unione test e-mail',
        'from_email' => 'from@test.com',
        'from_name' => 'Unione Test Script',
      ],
    ],
  ],

  'webhook' => [
    'set' => [
      [
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
  ],

  'request' => [
      [
        'path' => 'suppression/set.json',
        'body' => [
          'email' => 'user@example.com',
          'cause' => 'unsubscribed',
        ],
      ],
  ],
];

return $parameters;
