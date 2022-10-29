<?php

use PHPUnit\Framework\TestCase;
use Stirling\Core\Config;
use StirlingMySQL\Connection;
use StirlingMySQL\Entity;
use StirlingMySQL\Repository;

class RepositoryIntegrationTest extends TestCase
{
    private $testRepository;
    private $connection;

    public static function setUpBeforeClass(): void
    {
        Config::instance("test-resources/default.json");
        $db = Connection::Instance()->getDbLink();
        $sql = "CREATE TABLE test (id INT(11), foo VARCHAR(100))";
        mysqli_query($db, $sql);
    }

    protected function setUp(): void
    {
        $this->connection = Connection::Instance();
        $this->testRepository = new TestRepository();
    }

    protected function tearDown(): void
    {
        $sql = "TRUNCATE TABLE test";
        mysqli_query($this->connection->getDbLink(), $sql);
    }

    public function testInsert()
    {
        $entity = new TestEntity(array("id" => 0, "foo" => "bar"));
        $savedEntity = $this->testRepository->save($entity);
        $this->assertEquals($entity, $savedEntity);
    }

}

class TestRepository extends Repository
{
    /**
     * TestRepository constructor.
     */
    public function __construct()
    {
        parent::__construct('id', 'i', 'test', 'TestEntity');
    }
}

class TestEntity extends Entity
{
    public function getKey()
    {
        return $this->id;
    }
}