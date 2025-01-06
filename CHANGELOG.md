# Changelog

## [1.3.2](https://github.com/unione-repo/unione-php/compare/v1.3.1...v1.3.2) (2025-01-06)


### Miscellaneous Chores

* **master:** release 1.3.2 ([18e2a79](https://github.com/unione-repo/unione-php/commit/18e2a7928be105d49abf21fffcb9ef25b4c7ee8d))

## [1.3.1](https://github.com/unione-repo/unione-php/compare/v1.3.0...v1.3.1) (2024-12-31)


### Miscellaneous Chores

* **master:** release 1.3.1 ([eb9c43f](https://github.com/unione-repo/unione-php/commit/eb9c43f4327c13d382179d1e01af567e9c353172))

## [1.3.0](https://github.com/unione-repo/unione-php/compare/v1.2.0...v1.3.0) (2024-12-23)


### Features

* Added emails from 'CC' and 'BCC' headers to the 'recipients' array with substitutions and filter them by email address to remove duplicates. Checked and moved headers 'TO', 'CC', 'BCC' to the lower case if they are present in the other variants. Added the checking if it contains email for the 'TO' header, fixed checking for 'CC' and 'BCC' headers. ([807e1cd](https://github.com/unione-repo/unione-php/commit/807e1cd075dafae9fe21ade31c3d68b12d51d954))
* Added the CC and BCC headers support. Enabled strict mode according to https://docs.unione.io/en/cc-and-bcc if headers CC or BCC present. ([b490a7e](https://github.com/unione-repo/unione-php/commit/b490a7e6b07275d3d3200e45c28d58ea4b700237))
* Added the CC and BCC headers support. Enabled strict mode according to https://docs.unione.io/en/cc-and-bcc if headers CC or BCC present. ([31dfd53](https://github.com/unione-repo/unione-php/commit/31dfd534e55230f3cfe60513ca333bf1fcb05cd4))
* Added the CC and BCC headers support. Enabled strict mode according to https://docs.unione.io/en/cc-and-bcc if headers CC or BCC present. ([960a8cb](https://github.com/unione-repo/unione-php/commit/960a8cbda6cf8a16bc8a12f84a73682e797e726b))
* Added the CC and BCC headers support. Enabled strict mode according to https://docs.unione.io/en/cc-and-bcc if headers CC or BCC present. Added emails from 'CC' and 'BCC' headers to the 'recipients' array with substitutions and filtered them by email address to remove duplicates. Checked and moved headers 'TO', 'CC', 'BCC' to the lowercase if they are present in the other variants. Added the checking if it contains email for the 'TO' header, fixed checking for 'CC' and 'BCC' headers. ([59e9278](https://github.com/unione-repo/unione-php/commit/59e92780ffa293d10ff30f68e60d556e4ff87652))
* Added the CC and BCC headers support. Enabled strict mode according to https://docs.unione.io/en/cc-and-bcc if headers CC or BCC present. Added emails from 'CC' and 'BCC' headers to the 'recipients' array with substitutions and filtered them by email address to remove duplicates. Checked and moved headers 'TO', 'CC', 'BCC' to the lowercase if they are present in the other variants. Added the checking if it contains email for the 'TO' header, fixed checking for 'CC' and 'BCC' headers. ([bcc297b](https://github.com/unione-repo/unione-php/commit/bcc297be199136e3096e95ad08684df345032a4e))

## [1.2.0](https://github.com/unione-repo/unione-php/compare/v1.1.0...v1.2.0) (2023-05-11)


### Features

* Added additional parameters to the test script. Added testing of methods not implemented in the SDK. Changes have been made to the documentation file ([6b512a3](https://github.com/unione-repo/unione-php/commit/6b512a335d9d3d288168d4c2e8faf58c278c5378))
* Added description of how to pass the config file path ([d8bf80f](https://github.com/unione-repo/unione-php/commit/d8bf80fd2cfff815f8bab7108cb1e00a68700b1d))
* Added the ability to pass the absolute path to the configuration file in the command line ([ddb22ee](https://github.com/unione-repo/unione-php/commit/ddb22ee4e1a5667d1d37f0e97db61f34e9012aa4))
* Sets endpoint as required parameter in UnioneClient. Added changes to README.md ([88b8e57](https://github.com/unione-repo/unione-php/commit/88b8e5792e8daaca2cb04b0dc556f6dfb7cff640))
* UnioneApiChecker Includes composer vendor autoload ([fc6eccc](https://github.com/unione-repo/unione-php/commit/fc6eccc7de715628a2d059d2f61f654652d5ee05))

## [1.1.0](https://github.com/unione-repo/unione-php/compare/v1.0.0...v1.1.0) (2023-04-24)


### Features

* Added test script for Unione email send and webhook set methods test ([b4d0ffd](https://github.com/unione-repo/unione-php/commit/b4d0ffd6656aba438b6f8b22a5d489ca85f911e4))
* Added webhook validate method. To the UnioneClient added getApiKey method ([82b5165](https://github.com/unione-repo/unione-php/commit/82b51659f70a31379e2c80a43325f35bfff71bad))
* Added webhook validate method. To the UnioneClient added getApiKey method ([72ba02c](https://github.com/unione-repo/unione-php/commit/72ba02cc5553421cbded9c963a6d70b78bfc9f4a))
* Added Webhooks API supports to UnioneClient ([c3b7d55](https://github.com/unione-repo/unione-php/commit/c3b7d554a61ff36ab3bfe87dfd974e98b5f810b0))
* Added Webhooks API supports to UnioneClient ([64309d3](https://github.com/unione-repo/unione-php/commit/64309d375f19bc76026d013bae7161d2d846da55))


### Bug Fixes

* Allow empty body, subject, from_email values when the template is set. ([06a0a11](https://github.com/unione-repo/unione-php/commit/06a0a11ddf1472f3789d3f21cd4ed11c7d68e249))

## [1.0.0](https://github.com/unione-repo/unione-php/compare/v0.0.1...v1.0.0) (2023-04-03)


### ⚠ BREAKING CHANGES

* Constructor arguments order was changed
* Changed input parameter in send() method.

### Features

* Add email class ([0f763e3](https://github.com/unione-repo/unione-php/commit/0f763e33de1296ea27c686b10cb0b0bac9dfe4c4))
* Add exposed Guzzle configurations ([8dc9716](https://github.com/unione-repo/unione-php/commit/8dc971691c08511d15696fba1e6f4b83acbee914))
* Add new param and update release-please ([6e87dae](https://github.com/unione-repo/unione-php/commit/6e87daeb2eca0d0df9ea873d5b654083a154671b))
* Add style checking ([185c10a](https://github.com/unione-repo/unione-php/commit/185c10aa31d57c52c3e12e4beb5b42be2941c0bb))
* Add timeout ([b4b9423](https://github.com/unione-repo/unione-php/commit/b4b9423219e7c54566f8c1d78b940f7a97649d3f))
* Added json_decode server response ([6af1df5](https://github.com/unione-repo/unione-php/commit/6af1df593ba9a4ad4a5a54b5a2fb9b9d98275cd7))
* Added method subscribe in mail API ([1c112ee](https://github.com/unione-repo/unione-php/commit/1c112eec2bc9548a9f1ad81f7e1f6c6d8d507b19))
* Added Template sent class with all methods ([5b06aa8](https://github.com/unione-repo/unione-php/commit/5b06aa8af2b38eff6cb5794f59b6e876c82e8ace))
* Added Webmozart\Assert to validate subscribe method array keys ([30ee94b](https://github.com/unione-repo/unione-php/commit/30ee94b097cd733ac285399ccd32c3774546f8ed))
* **API:** Unione PHP SDK v1.0.0. ([2766b33](https://github.com/unione-repo/unione-php/commit/2766b33bf2458b59405a9ed49b0879fc31418925))


### Bug Fixes

* Add parameter 'platform' ([46856cd](https://github.com/unione-repo/unione-php/commit/46856cd48cfcfae1dda08785c378c79980bac159))
* Add request headers parameter ([3acce82](https://github.com/unione-repo/unione-php/commit/3acce82de2407254a8c47d7ff13590fdcec1697d))
* Add set() method ([145c04c](https://github.com/unione-repo/unione-php/commit/145c04c33d11863c50c352bc1e7d7cc1d9390636))
* Changed namespace and method ([c01ef05](https://github.com/unione-repo/unione-php/commit/c01ef05869964faecff759436ca66979c784e7ef))
* Changed php-cs-fixer in github action from version 3.9.5 to 3.13 ([dacf8a8](https://github.com/unione-repo/unione-php/commit/dacf8a81aacee7aa57708dae803c181fb81d5e14))
* Convert recipients array ([831b553](https://github.com/unione-repo/unione-php/commit/831b553b007e837972a133b29b68a5aa60ab31b4))
* Corrected the code according to comments ([933e771](https://github.com/unione-repo/unione-php/commit/933e7713b7111a81be8b59a86e46795f28779808))
* Fix code style ([e198dd2](https://github.com/unione-repo/unione-php/commit/e198dd24b25e56c07c41fd5fb51cbbfeb6b39d6f))
* Fix code variable name bug ([f0bc498](https://github.com/unione-repo/unione-php/commit/f0bc4986d1ccf2e43f3bfa3c50cef05bcfd1d785))
* Fix release-please.yml file ([f577d74](https://github.com/unione-repo/unione-php/commit/f577d740612c3c5760188707b6f8034ea07fb216))
* Fix return value Email::send method. UniOneClient::httpRequest now return array or throw GuzzleException ([066196a](https://github.com/unione-repo/unione-php/commit/066196a1517887abd1c6e796729f3526201129ae))
* Fix return value UniOneClient::httpRequest is now associative array ([b475fd0](https://github.com/unione-repo/unione-php/commit/b475fd0426eb44eb9e1021954b6f9be2d5037b67))
* Update php-cs-fixer to version 3.15 ([ace4195](https://github.com/unione-repo/unione-php/commit/ace4195709f89207d6c869dc61e2dac22d7d8226))


### Code Refactoring

* Made endpoint optional ([3d15d16](https://github.com/unione-repo/unione-php/commit/3d15d16d055a098def05b206531521167574ac7d))

## 0.0.1 (2022-11-15)


### Features

* Add new param and update release-please ([6e87dae](https://github.com/unione-repo/unione-php/commit/6e87daeb2eca0d0df9ea873d5b654083a154671b))
* Add style checking ([185c10a](https://github.com/unione-repo/unione-php/commit/185c10aa31d57c52c3e12e4beb5b42be2941c0bb))
* Add timeout ([b4b9423](https://github.com/unione-repo/unione-php/commit/b4b9423219e7c54566f8c1d78b940f7a97649d3f))
* **API:** Unione PHP SDK v1.0.0. ([2766b33](https://github.com/unione-repo/unione-php/commit/2766b33bf2458b59405a9ed49b0879fc31418925))
