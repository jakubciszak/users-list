<?php

namespace App\Tests\DataSources;

use App\DataSources\RequeresDataSource;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class RequeresDataSourceTest
 * @package App\Tests\DataSources
 */
class RequeresDataSourceTest extends TestCase
{
    private $client;

    public function setUp()
    {
        parent::setUp();
        $handlerStack = HandlerStack::create($this->getMockHandler());
        $this->client = new Client(['handler' => $handlerStack]);
    }

    public function testGetUsers(): void
    {
        /** @noinspection PhpParamsInspection */
        $dataSource = new RequeresDataSource($this->getMockedContainer());
        $dataSource->setClient($this->client);
        $users = $dataSource->getUsers();
        $this->assertInstanceOf(ParameterBag::class, $users);
        $this->assertSame(2, $users->get('page'));
        $this->assertSame(3, $users->get('per_page'));
        $this->assertSame(4, $users->get('total_pages'));
        $this->assertCount(3, $users->get('data'));
    }

    /**
     * @expectedException \BadFunctionCallException
     */
    public function testExceptionWithoutClient(): void
    {
        /** @noinspection PhpParamsInspection */
        $dataSource = new RequeresDataSource($this->getMockedContainer());
        $dataSource->getUsers();
    }

    /**
     * @return bool|string
     */
    private function getMockedData()
    {
        return \file_get_contents(__DIR__ .'/../Mock/users.json');
    }

    /**
     * @return MockHandler
     */
    private function getMockHandler(): MockHandler
    {
        return new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], $this->getMockedData())
        ]);
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    private function getMockedContainer(): \PHPUnit\Framework\MockObject\MockObject
    {
        return $this->getMockBuilder(Container::class)->setMethods(['getParameter'])->getMock();
    }
}
