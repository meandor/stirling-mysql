<?php

use PHPUnit\Framework\TestCase;
use StirlingMySQL\Entity;

class EntityTest extends TestCase
{
    public function testGetReturnsExistingProperty()
    {
        $entity = new EntityTestEntity(["foo" => "bar"]);

        $this->assertSame("bar", $entity->foo);
    }

    public function testGetReturnsNullForMissingProperty()
    {
        $entity = new EntityTestEntity(["foo" => "bar"]);

        $this->assertNull($entity->baz);
    }
}

class EntityTestEntity extends Entity
{
    public function getKey()
    {
        return null;
    }
}
