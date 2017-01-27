<?php
namespace StirlingMySQL;

use Stirling\Database\Repository;

abstract class MysqlRepository implements Repository
{

    protected $key;

    protected $table;

    protected $link;

    /**
     * MysqlRepository constructor.
     * @param $key
     * @param $table
     */
    public function __construct($key, $table)
    {
        $this->key = $key;
        $this->table = $table;
        $this->link = MysqlConnection::Instance()->getDbLink();
    }

    public function fetchAll()
    {
        $query = "SELECT * FROM `" . $this->table . "`";
        $res = $this->link->query($query);
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function findOne($key)
    {
        $stmt = $this->link->prepare("SELECT * FROM `" . $this->table . "` WHERE " . $this->key . "=?");
        $stmt->bind_param("s", $key);
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        $stmt->close();
        return $result;
    }

    public function search($constraint)
    {
        // TODO: Implement search() method.
    }

    public function delete($key)
    {
        $stmt = $this->link->prepare("DELETE FROM `" . $this->table . "` WHERE " . $this->key . "=?");
        $stmt->bind_param("s", $key);
        $stmt->execute();
        $stmt->close();
    }

    public function save($object)
    {
        // TODO: Implement save() method.
    }
}
