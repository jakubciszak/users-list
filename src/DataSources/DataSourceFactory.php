<?php

namespace App\DataSources;

use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ApiConnectorFactory
 * @package App\DataFixtures
 */
class DataSourceFactory
{
    use ContainerAwareTrait;

    public const REQRES_API_NAME = 'reqres';

    public const FAKE_API_NAME = 'fake';

    /**
     * ApiConnectorFactory constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    /**
     * @param string $name
     * @return AbstractDataSource
     */
    public function getDataSource(string $name): AbstractDataSource
    {
        switch ($name) {
            case self::FAKE_API_NAME:
                return new FakeDataSource($this->container);
            case self::REQRES_API_NAME:
            default:
                return new RequeresDataSource($this->container);
        }
    }
}