<?php

declare(strict_types=1);

namespace UnioneUtility;

use Composer\Script\Event;
use Unione\UnioneClient;

class UnioneApiChecker
{
    /**
     * The UnioneClient client.
     *
     * @var UnioneClient
     */
    private static UnioneClient $client;

    /**
     * The script config file.
     *
     * @var array
     */
    private static $config;

    /**
     * The array with error messages.
     *
     * @var array
     */
    private static $messages = [];

    /**
     * Check Unione API methods.
     *
     * @param \Composer\Script\Event $event
     *
     * @return void
     */
    public static function check_api(Event $event)
    {
        self::$config = require_once 'config.php';
        $args = $event->getArguments();
        if (!empty($args[0]) || !empty($args[1])) {
            self::$client = new UnioneClient($args[1], $args[0]);
            self::sendMail();
            self::setHook();
            self::showMessages();
        }
    }

    /**
     * Shows console message.
     *
     * @return void
     */
    public static function showMessages()
    {
        if (!empty(self::$messages)) {
            foreach (self::$messages as $item) {
                echo $item.PHP_EOL;
            }
        }

        $exit_status = \count(self::$messages);
        \printf('Exiting with a code of %d'.PHP_EOL, $exit_status);
        exit($exit_status);
    }

    /**
     * Test Unione send email.
     *
     * @return void
     */
    private static function sendMail()
    {
        if (!empty(self::$config['email']['send'])) {
            try {
                $data = self::$client->emails()->send(self::$config['email']['send']);
            } catch (\Exception $error) {
                self::$messages[] = $error->getMessage();
            }
        }
    }

  /**
   * Test Unione set hook.
   *
   * @return void
   */
  private static function setHook()
  {
      if (!empty(self::$config['webhook']['set'])) {
          try {
              $data = self::$client->webhooks()->set(self::$config['webhook']['set']);
          } catch (\Exception $error) {
              self::$messages[] = $error->getMessage();
          }
      }
  }
}
