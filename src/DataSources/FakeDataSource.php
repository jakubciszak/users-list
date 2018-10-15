<?php

namespace App\DataSources;

use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class FakeApiConnector
 * @package App\DataFixtures
 */
class FakeDataSource extends AbstractDataSource
{
    /**
     * @param int $start
     * @param int $length
     * @return ParameterBag
     */
    public function getUsers(int $start = 0, int $length = 10): ParameterBag
    {
        return new ParameterBag();
    }
}