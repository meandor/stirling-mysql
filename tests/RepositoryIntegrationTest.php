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
        mysqli_query($db, "DROP TABLE IF EXISTS test");
        $sql = "CREATE TABLE test (foo VARCHAR(100), id INT(11))";
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
        $entity = new TestEntity(["id" => 0, "foo" => "bar"]);
        $savedEntity = $this->testRepository->save($entity);
        $this->assertEquals($entity, $savedEntity);
    }

    public function testInsertWithExplicitKey()
    {
        $entity = new TestEntity(["id" => 42, "foo" => "bar"]);
        $savedEntity = $this->testRepository->save($entity);
        $this->assertEquals($entity, $savedEntity);
    }

    public function testFindOneReturnsNullForUnknownKey()
    {
        $this->assertNull($this->testRepository->findOne(999));
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
