# Stirling MySQL
[![Latest Stable Version](https://poser.pugx.org/meandor/stirling-microservice/v/stable)](https://packagist.org/packages/meandor/stirling-microservice)
[![Total Downloads](https://poser.pugx.org/meandor/stirling-microservice/downloads)](https://packagist.org/packages/meandor/stirling-microservice)
[![Latest Unstable Version](https://poser.pugx.org/meandor/stirling-microservice/v/unstable)](https://packagist.org/packages/meandor/stirling-microservice)
[![License](https://poser.pugx.org/meandor/stirling-microservice/license)](https://packagist.org/packages/meandor/stirling-microservice)
[![Monthly Downloads](https://poser.pugx.org/meandor/stirling-microservice/d/monthly)](https://packagist.org/packages/meandor/stirling-microservice)
[![Daily Downloads](https://poser.pugx.org/meandor/stirling-microservice/d/daily)](https://packagist.org/packages/meandor/stirling-microservice)
[![composer.lock](https://poser.pugx.org/meandor/stirling-microservice/composerlock)](https://packagist.org/packages/meandor/stirling-microservice)
[![Build Status](https://travis-ci.org/meandor/stirling-mysql.svg?branch=master)](https://travis-ci.org/meandor/stirling-mysql)

A MySQL Database wrapper for the [stirling-microservice](https://github.com/meandor/stirling-microservice)

This library uses mysqli for database access. Please make sure you have
mysqli enabled and ready to work on your server.

## Usage
This library only works in conjunction with the
[stirling-microservice](https://github.com/meandor/stirling-microservice).

If you don't specify a config json (default.json) for your Config class
 with the following lines
 
````json
{
    "dbHost": "<ip address>",
    "dbUser": "<my username>",
    "dbPassword": "<my password>",
    "dbName": "<my database name>",
    "dbPort": <port>
}
````

a default config will be used to try to establish a database connection.

The default is:

````json
{
    "dbHost": "127.0.0.1",
    "dbUser": "root",
    "dbPassword": "",
    "dbName": "database",
    "dbPort": 3306
}
````

 