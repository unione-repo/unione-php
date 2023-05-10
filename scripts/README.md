# UniOne API test script

With the help of this script, you can test API methods with given API key and host:
* If the check is successful, the script returns status code 0.
* If there are any issues, script returns amount of errors and shows error messages.

Usage:

```bash
compose require unione/unione-php
cd vendor/unione/unione-php && composer test {YOUR-HOST-NAME} {YOUR-API-KEY} {WEBHOOK-SET-URL} {EMAIL-SEND-FROM-EMAIL} {CONFIG-FILE-PATH}
```
You can change parameters in the **config.php** file.

**{WEBHOOK-SET-URL}** **{EMAIL-SEND-FROM-EMAIL}** parameters are optional. If it's set they override default values in the **config.php** file.

**{CONFIG-FILE-PATH}** parameter is optional. If it's not set, it'll try to find
the config file in project root and unione-php package.
