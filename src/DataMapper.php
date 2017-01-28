<?php
namespace StirlingMySQL;


use \Stirling\Database\IDataMapper;
use \Stirling\Database\IEntity;

class DataMapper implements IDataMapper
{

    private $entityClassName;

    /**
     * DataMapper constructor.
     * @param $entityClassName
     */
    public function __construct($entityClassName)
    {
        $this->entityClassName = $entityClassName;
    }


    /**
     * Returns created IEntity
     * @param $dbData array raw data from the database
     * @return IEntity
     */
    function createEntity(array $dbData): IEntity
    {
        return new $this->entityClassName($dbData);
    }
}