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
            $config = self::getConfig();

            if (\count($args) < 2) {
                $io->write('Please enter HOSTNAME and APIKEY parameters. Example: composer test UNIONE-HOSTNAME UNIONE-API-KEY', true);
                exit(1);
            }
            if (empty($config)) {
                $io->write('Please rename example.config.php to config.php and enter your information to $parameters array. Details on README.md file', true);
                exit(1);
            }

            $api_checker = new UnioneApiChecker($args, $config);
            $api_checker->sendMail();
            $api_checker->setWebhook();
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
   * Returns config file.
   *
   * @return false|mixed
   */
  public static function getConfig()
  {
      $composerRootPath = self::getComposerRootPath();

      if (!empty($args[2]) && \file_exists($args[2])) {
          return require_once $args[2];
      } elseif (!empty($composerRootPath) && \file_exists($composerRootPath.'/config.php')) {
          return require_once $composerRootPath.'/config.php';
      } elseif (\file_exists(__DIR__.'/config.php')) {
          return require_once __DIR__.'/config.php';
      }

      return false;
  }
}
