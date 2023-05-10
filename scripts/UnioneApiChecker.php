<?php

declare(strict_types=1);

namespace UnioneScripts;

require UnioneApiChecker::getComposerRootPath().'/vendor/autoload.php';

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
     * The args array.
     *
     * @var array
     */
    private array $args;

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
        $this->args = $args;
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
            $config = self::getConfig();

            if (\count($args) < 2) {
                $io->write('Please enter HOSTNAME and APIKEY parameters. Example: composer test UNIONE-HOSTNAME UNIONE-API-KEY', true);
                exit(1);
            }
            if (empty($config)) {
                $io->write('Config file was not found. See README.md for details.', true);
                exit(1);
            }

            $api_checker = new UnioneApiChecker($args, $config);
            $api_checker->sendMail();
            $api_checker->setWebhook();
            $api_checker->request();
            $exit_status = $api_checker->showMessages($io);
            $io->write("Exiting with a code of $exit_status", true);
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
                    if (!empty($this->args[3])) {
                        $message['from_email'] = $this->args[3];
                    }
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
                  if (!empty($this->args[2])) {
                      $webhook['url'] = $this->args[2];
                  }
                  try {
                      $this->client->webhooks()->set($webhook);
                  } catch (\Exception $error) {
                      $this->messages[] = $error->getMessage();
                  }
              }
          }
      }

      /**
       * Test Unione API methods, that are not implemented in SDK yet.
       *
       * @return void
       */
      public function request()
      {
          if (!empty($this->config['request'])) {
              foreach ($this->config['request'] as $request) {
                  try {
                      $this->client->httpRequest($request['path'], $request['body']);
                  } catch (\Exception $error) {
                      $this->messages[] = $error->getMessage();
                  }
              }
          }
      }

  /**
   * Shows error messages in console.
   *
   * @return int an errors count
   */
  private function showMessages(IOInterface $io): int
  {
      if (!empty($this->messages)) {
          foreach ($this->messages as $item) {
              $io->write($item, true);
          }
      }

      return \count($this->messages);
  }

   /**
    * Returns composer root path.
    *
    * @return false|string
    */
   public static function getComposerRootPath()
   {
       $dir = \getcwd();

       do {
           if (\file_exists($dir.'/vendor/autoload.php')) {
               return $dir;
           }
       } while ($dir = \dirname($dir));

       return false;
   }

  /**
   * Returns config file or false if not found.
   *
   * @return false|mixed
   */
  public static function getConfig()
  {
      $composerRootPath = self::getComposerRootPath();

      if (!empty($args[4]) && \file_exists($args[4])) {
          return require_once $args[4];
      } elseif (!empty($composerRootPath) && \file_exists($composerRootPath.'/config.php')) {
          return require_once $composerRootPath.'/config.php';
      } elseif (\file_exists(__DIR__.'/config.php')) {
          return require_once __DIR__.'/config.php';
      }

      return false;
  }
}
