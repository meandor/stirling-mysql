# Stirling MySQL
A MySQL Database wrapper for the [stirling-microservice](https://github.com/meandor/stirling-microservice).

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
    "dbName": "<my database name>"
}
````

a default config will be used to try to establish a database connection.

The default is:

````json
{
    "dbHost": "127.0.0.1",
    "dbUser": "root",
    "dbPassword": "",
    "dbName": "database"
}
````

 