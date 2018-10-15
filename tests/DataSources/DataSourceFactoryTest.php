<?php

namespace App\Tests\DataSources;


use App\DataSources\DataSourceFactory;
use App\DataSources\FakeDataSource;
use App\DataSources\RequeresDataSource;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;

/**
 * Class ApiConnectionFactoryTest
 * @package App\Tests
 */
class DataSourceFactoryTest extends TestCase
{
    /**
     * @dataProvider ApiConnectorKeys
     * @param string $excepted
     * @param string $key
     */
    public function testGetDataSource(string $excepted, string $key): void
    {
        $containerMock = $this->getMockBuilder(Container::class)->setMethods(['getParameter'])->getMock();
        $factory = new DataSourceFactory($containerMock);
        $this->assertInstanceOf(
            $excepted,
            $factory->getDataSource($key),
            "Returned incorrect object by key: $key"
        );
    }

    /**
     * @return array
     */
    public function ApiConnectorKeys(): array
    {
        return [
            [RequeresDataSource::class, DataSourceFactory::REQRES_API_NAME],
            [FakeDataSource::class, DataSourceFactory::FAKE_API_NAME]
        ];
    }
}