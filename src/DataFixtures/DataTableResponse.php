<?php

namespace App\DataFixtures;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class DataTableResponse
 * @package App\DataFixtures
 */
class DataTableResponse extends JsonResponse
{
    public const DEFAULT_LENGTH = 10;

    /**
     * DataTableResponse constructor.
     * @param int $draw
     * @param int $recordsTotal
     * @param int $filteredTotal
     * @param mixed|mixed $data
     */
    public function __construct(int $draw, int $recordsTotal, int $filteredTotal, $data = null)
    {
        parent::__construct($this->prepareData($draw, $recordsTotal, $filteredTotal, $data));
    }

    /**
     * @param int $draw
     * @param int $recordsTotal
     * @param int $filteredTotal
     * @param mixed $data
     * @return array
     */
    private function prepareData(int $draw, int $recordsTotal, int $filteredTotal, $data = null): array
    {
        return [
            'draw' => $draw,
            'recordsTotal'=> $recordsTotal,
            'recordsFiltered' => $filteredTotal,
            'data' => $data
        ];
    }
}