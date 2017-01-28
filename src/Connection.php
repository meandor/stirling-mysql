<?php
namespace StirlingMySQL;

use InvalidArgumentException;
use mysqli;
use \Stirling\Core\Config;
use \Stirling\Database\IConnection;

class Connection implements IConnection
{

    private static $connection;
    private $dbLink;

    private function __construct()
    {
        $config = Config::instance();
        try {
            $this->dbLink = new mysqli($config->dbHost, $config->dbUser, $config->dbPassword, $config->dbName);
        } catch (InvalidArgumentException $e) {
            error_log($e->getMessage());
            error_log("Using default database config values");
            $this->dbLink = new mysqli("127.0.0.1", "root", "", "database");
        }

        if ($this->dbLink->connect_errno) {
            $err = "Error: Failed to make a MySQL connection, here is why: \n";
            $err .= "Errno: " . $this->dbLink->connect_errno . "\n";
            $err .= "Error: " . $this->dbLink->connect_error . "\n";
            error_log($err);
            exit;
        }
    }

    public static function Instance(): IConnection
    {
        if (self::$connection == null) {
            self::$connection = new Connection();
        }

        return self::$connection;
    }

    /**
     * @return mysqli
     */
    public function getDbLink()
    {
        return $this->dbLink;
    }
}
