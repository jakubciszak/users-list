<?php

namespace App\Tests\DataFixtures;

use App\DataFixtures\DataTableResponse;
use PHPUnit\Framework\TestCase;

/**
 * Class DataTableResponseTest
 * @package App\Tests\DataFixtures
 */
class DataTableResponseTest extends TestCase
{
    public function testConstructorWithArrayData(): void
    {
        $response = new DataTableResponse(2, 33, 33, [['name' => 'john']]);
        $this->assertEquals(
            '{"draw":2,"recordsTotal":33,"recordsFiltered":33,"data":[{"name":"john"}]}',
            $response->getContent()
        );
    }

    public function testConstructorWithObjectData(): void
    {
        $user = new \stdClass();
        $user->name = 'john';
        $user2 = new \stdClass();
        $user2->name = 'will';
        $response = new DataTableResponse(2, 33, 33, [$user, $user2]);
        $this->assertEquals(
            '{"draw":2,"recordsTotal":33,"recordsFiltered":33,"data":[{"name":"john"},{"name":"will"}]}',
            $response->getContent()
        );
    }
}