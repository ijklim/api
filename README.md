# API

An intermediate server to insert api key to http request.


## Technologies/Modules used

* Php


# Packages

* `phpunit`, added using `composer require --dev phpunit/phpunit`
* `phpdotenv`, added using `composer require vlucas/phpdotenv`


# Deployment on shared hosting

* Run `composer install`
* Upload all files and folders to remote folder on web host, e.g. `/public_html__api`
* Create a subdomain to point to the folder, e.g. `api.my-domain.com`
* Specify api keys in `.env` file, samples available in `.env.example`
* Specify valid domain names that can access api in `.env`


# Usage

  ```
  https://api.my-domain.com/?a=dictionary&word=divine
  ```

* More api end points can be added to array `KEY_TYPES` in `models\api.php`.


# Testing

* Test scripts are in the `tests` folder
* A sample shell script `tests/testPhpUnit.sh` is included for reference
* More command-line options can be found at https://phpunit.readthedocs.io/en/9.3/textui.html
