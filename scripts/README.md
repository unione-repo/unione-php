# UniOne API test script

Usage:

```bash
compose require unione/unione-php
cd vendor/unione/unione-php && composer test {YOUR-HOST-NAME} {YOUR-API-KEY}
```
You should copy example.config.php to config.php file and set your parameters.

With the help of this script, you can test Email send and Webhook set methods:
* If the check is successful. The script returns status code 0.
* If has error, script shows error message and return status code with error counts.
