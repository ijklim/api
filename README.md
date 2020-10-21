# API

An intermediate server to insert api key to http request.


## Technologies/Modules used

* Php


# Deployment on shared hosting

* Run `composer install`
* Upload `index.php` and folder `vendor` to folder on the remote server, e.g. `/public_html__api`
* Create a subdomain to point to the folder, e.g. `api.my-domain.com`
* Specify api keys in `.env` file, samples available in `.env.example`


# Usage

  ```
  https://api.my-domain.com/?a=dictionary&word=divine
  ```

* More api end points can be added to array `$apiKeyMappings` in `index.php`.
* The `Access-Control-Allow-Origin` setting in `index.php` controls which domain can access the api.