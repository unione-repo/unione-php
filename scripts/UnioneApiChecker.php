<?php

declare(strict_types=1);

namespace UnioneScripts;

use Composer\Script\Event;
use Unione\UnioneClient;

class UnioneApiChecker
{
    /**
     * The UnioneClient client.
     *
     * @var UnioneClient
     */
    private UnioneClient $client;

    /**
     * The script config file.
     *
     * @var array
     */
    private $config;

    /**
     * The array with error messages.
     *
     * @var array
     */
    private $messages = [];

    public function __construct(array $args, array $config)
    {
        $this->client = new UnioneClient($args[1], $args[0]);
        $this->config = $config;
    }

        /**
         * Check Unione API methods.
         *
         * @param \Composer\Script\Event $event
         *
         * @return void
         */
        public static function testApi(Event $event)
        {
            $args = $event->getArguments();

            if (empty($args) || \count($args) < 2) {
                echo 'Please enter HOSTNAME and APIKEY parameters. Valid command is: composer test UNIONE-HOSTNAME UNIONE-API-KEY'.PHP_EOL;
                exit(1);
            }

            if (!\file_exists(__DIR__.'/config.php')) {
                echo 'Please rename example.config.php to config.php and enter your information to $parameters array. Details on README.md file'.PHP_EOL;
                exit(1);
            }

            $config = require_once 'config.php';

            $api_checker = new UnioneApiChecker($args, $config);
            $api_checker->sendMail();
            $api_checker->setHook();
            $api_checker->showMessages();
        }

        /**
         * Shows console message.
         *
         * @return void
         */
        public function showMessages()
        {
            if (!empty($this->messages)) {
                foreach ($this->messages as $item) {
                    echo $item.PHP_EOL;
                }
            }

            $exit_status = \count($this->messages);
            \printf('Exiting with a code of %d'.PHP_EOL, $exit_status);
            exit($exit_status);
        }

        /**
         * Test Unione send email.
         *
         * @return void
         */
        public function sendMail()
        {
            if (!empty($this->config['email']['send'])) {
                try {
                    $data = $this->client->emails()->send($this->config['email']['send']);
                } catch (\Exception $error) {
                    $this->messages[] = $error->getMessage();
                }
            }
        }

      /**
       * Test Unione set hook.
       *
       * @return void
       */
      public function setHook()
      {
          if (!empty($this->config['webhook']['set'])) {
              try {
                  $data = $this->client->webhooks()->set($this->config['webhook']['set']);
              } catch (\Exception $error) {
                  $this->messages[] = $error->getMessage();
              }
          }
      }
}
