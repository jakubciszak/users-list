<?php

namespace App\DataSources;

use GuzzleHttp\Client;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class AbstractApiConnector
 * @package App\DataFixtures
 */
abstract class AbstractDataSource
{
    use ContainerAwareTrait;

    /**
     * @var ParameterBag
     */
    protected $users;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @param int $start
     * @param int $length
     * @return ParameterBag
     */
    abstract public function getUsers(int $start = 0, int $length = 10): ParameterBag;

    /**
     * AbstractApiConnector constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    /**
     * @param Client $client
     * @return AbstractDataSource
     */
    public function setClient(Client $client): AbstractDataSource
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return Client
     */
    protected function getClient(): Client
    {
        if ($this->client === null) {
            throw new \BadFunctionCallException('Client is not set!');
        }
        return $this->client;
    }
}