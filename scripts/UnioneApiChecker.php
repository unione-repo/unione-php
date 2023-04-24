<?php

declare(strict_types=1);

namespace UnioneScripts;

use Composer\IO\IOInterface;
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
    private array $config;

    /**
     * The array with error messages.
     *
     * @var array
     */
    private array $messages = [];

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
            $io = $event->getIO();

            if (\count($args) < 2) {
                $io->write('Please enter HOSTNAME and APIKEY parameters. Example: composer test UNIONE-HOSTNAME UNIONE-API-KEY');
                exit(1);
            }

            if (!\file_exists(__DIR__ . '/config.php')) {
                $io->write('Please rename example.config.php to config.php and enter your information to $parameters array. Details on README.md file');
                exit(1);
            }

            $config = require_once 'config.php';

            $api_checker = new UnioneApiChecker($args, $config);
            $api_checker->sendMail();
            $api_checker->setWebhook();
            $exit_status = $api_checker->showMessages($io);
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
                foreach ($this->config['email']['send'] as $message) {
                    try {
                        $this->client->emails()->send($message);
                    } catch (\Exception $error) {
                        $this->messages[] = $error->getMessage();
                    }
                }
            }
        }

      /**
       * Test Unione set hook.
       *
       * @return void
       */
      public function setWebhook()
      {
          if (!empty($this->config['webhook']['set'])) {
              foreach ($this->config['webhook']['set'] as $webhook) {
                  try {
                      $this->client->webhooks()->set($webhook);
                  } catch (\Exception $error) {
                      $this->messages[] = $error->getMessage();
                  }
              }
          }
      }

  /**
   * Shows error messages in console.
   *
   * @return int;
   */
  private function showMessages(IOInterface $io): int
  {
      if (!empty($this->messages)) {
          foreach ($this->messages as $item) {
              $io->write($item);
          }
      }

      $exit_status = \count($this->messages);
      $io->write("Exiting with a code of $exit_status");

      return $exit_status;
  }
}
