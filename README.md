# Stirling MySQL
[![Latest Stable Version](https://poser.pugx.org/meandor/stirling-mysql/v/stable)](https://packagist.org/packages/meandor/stirling-mysql)
[![Total Downloads](https://poser.pugx.org/meandor/stirling-mysql/downloads)](https://packagist.org/packages/meandor/stirling-mysql)
[![Latest Unstable Version](https://poser.pugx.org/meandor/stirling-mysql/v/unstable)](https://packagist.org/packages/meandor/stirling-mysql)
[![License](https://poser.pugx.org/meandor/stirling-mysql/license)](https://packagist.org/packages/meandor/stirling-mysql)
[![Monthly Downloads](https://poser.pugx.org/meandor/stirling-mysql/d/monthly)](https://packagist.org/packages/meandor/stirling-mysql)
[![Daily Downloads](https://poser.pugx.org/meandor/stirling-mysql/d/daily)](https://packagist.org/packages/meandor/stirling-mysql)
[![composer.lock](https://poser.pugx.org/meandor/stirling-mysql/composerlock)](https://packagist.org/packages/meandor/stirling-mysql)
[![CI](https://github.com/meandor/stirling-mysql/actions/workflows/ci.yml/badge.svg?branch=master)](https://github.com/meandor/stirling-mysql/actions/workflows/ci.yml)

A MySQL Database wrapper for the [stirling-microservice](https://github.com/meandor/stirling-microservice)

This library uses mysqli for database access. Please make sure you have
mysqli enabled and ready to work on your server.

## Tools
The main script to do everything is
````bash
./bin/go
````

To see a list of arguments:
````bash
./bin/go help
````

To execute all tests:
````bash
./bin/go test
````

To scan the code and its dependencies for vulnerabilities, secrets and
misconfigurations with [Trivy](https://trivy.dev/) (runs inside Docker,
no binary to install — the image is pulled automatically on first run):
````bash
./bin/go security-check
````

This scans `composer.lock` (including dev dependencies) for known
vulnerabilities. It is a dependency scan, not a scan of your PHP source
code.

To check the code style with PHP CS Fixer (validates, does not change files):
````bash
./bin/go lint-check
````

To auto-fix the code style with PHP CS Fixer:
````bash
./bin/go lint
````

To statically analyse the code with PHPStan (level 4, checks `src/`):
````bash
./bin/go static-analysis
````

To check that no method exceeds the configured cyclomatic complexity threshold
(uses PHPMD):
````bash
./bin/go complexity
````

To run lint-check, static-analysis, mutation-check, security-check, the
complexity check and the tests all at once:
````bash
./bin/go check
````

The tests and mutation-check need a MySQL server. The defaults are
`127.0.0.1:3306`, user `root`, an empty password and the database `test`.

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

 