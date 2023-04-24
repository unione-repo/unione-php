# Changelog

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
