<?php

namespace StirlingMySQL;

use Stirling\Database\IEntity;
use Stirling\Database\IRepository;

abstract class Repository implements IRepository
{

    protected $key;

    /**
     * @var String representation for the key data type.
     *    i        corresponding variable has type integer
     *    d        corresponding variable has type double
     *    s        corresponding variable has type string
     *    b        corresponding variable is a blob and will be sent in packets
     */
    protected $keyType;

    protected $table;

    protected $link;

    protected $dataMapper;

    /**
     * Repository constructor.
     * @param $key
     * @param $keyType
     * @param $table
     * @param $entityClassName
     */
    public function __construct($key, $keyType, $table, $entityClassName)
    {
        $this->key = $key;
        $this->table = $table;
        $this->keyType = $keyType;
        $this->link = Connection::Instance()->getDbLink();
        $this->dataMapper = new DataMapper($entityClassName);
    }

    public function fetchAll(): array
    {
        $entities = array();
        $query = "SELECT * FROM `" . $this->table . "`";
        $res = $this->link->query($query);

        foreach ($res->fetch_all(MYSQLI_ASSOC) as $dbRow) {
            $entities[] = $this->dataMapper->createEntity($dbRow);
        }
        return $entities;
    }

    public function findOne($keyValue): ?IEntity
    {
        $stmt = $this->link->prepare("SELECT * FROM `" . $this->table . "` WHERE " . $this->key . "=?");
        $stmt->bind_param($this->keyType, $keyValue);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            return null;
        }
        $row = $result->fetch_assoc();
        $stmt->close();
        return $this->dataMapper->createEntity($row);
    }

    public function delete(IEntity $entity): bool
    {
        $stmt = $this->link->prepare("DELETE FROM `" . $this->table . "` WHERE " . $this->key . "=?");
        $stmt->bind_param($this->keyType, $entity->getKey());
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function save(IEntity $entity): ?IEntity
    {
        $keySpace = $this->transformKeySpace(array_keys($entity->getProperties()));
        $values = $this->transformKeyValues(array_values($entity->getProperties()));
        $sql = "INSERT INTO " . $this->table . " " . $keySpace . " VALUES " . $values;
        if ($this->link->query($sql) === TRUE) {
            return $this->findOne($this->link->insert_id);
        } else {
            return null;
        }
    }

    private function transformKeySpace($keySpace)
    {
        $result = "(";
        foreach ($keySpace as $key) {
            $result .= "`" . $key . "`,";
        }
        $result = rtrim($result, ",");
        $result .= ")";
        return $result;
    }

    private function transformKeyValues($keyValues)
    {
        $result = "(";
        foreach ($keyValues as $value) {
            $result .= "'" . $value . "',";
        }
        $result = rtrim($result, ",");
        $result .= ")";
        return $result;
    }
}
