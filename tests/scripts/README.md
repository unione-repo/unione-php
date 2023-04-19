# UniOne API test script
This script gives an opportunity to test the Unione API: https://docs.unione.io/en/web-api-ref#web-api

With the help of this script, you can test Email send and Webhook set methods:

* If If the check is successful. The script returns status code 0.
* If has error, script shows error message and return status code with error counts.



## How it works
* Go to the YOUR-PROJECT/vendor/unione/unione-php/tests/scripts folder
* Rename example.config.php file to config.php
* Fill your data in config array
* Go to the YOUR-PROJECT/vendor/unione/unione-php
* Use Composer to run the script enter
```bash
composer test UNIONE-HOSTNAME UNIONE-API-KEY
```


