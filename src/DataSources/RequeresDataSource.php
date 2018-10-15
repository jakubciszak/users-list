<?php

namespace App\DataSources;

use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class RequeresApiConnector
 * @package App\DataFixtures
 */
class RequeresDataSource extends AbstractDataSource
{
    /**
     * @param int $start
     * @param int $length
     * @return ParameterBag
     */
    public function getUsers(int $start = 0, int $length = 10): ParameterBag
    {
        $page = ($start / $length)+1;
        $data = json_decode($this->getClient()
            ->get("users?per_page=$length&page=$page")->getBody()->getContents(), true);
        if ($this->users === null) {
            $this->users = new ParameterBag($data);
        }
        return $this->users;
    }
}