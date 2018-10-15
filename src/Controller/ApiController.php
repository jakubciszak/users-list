<?php

namespace App\Controller;

use App\DataFixtures\DataTableResponse;
use App\DataSources\DataSourceFactory;
use GuzzleHttp\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ApiController
 * @package App\Controller
 */
class ApiController extends Controller
{
    /**
     * @Route("/api/users", methods={"GET","HEAD"})
     * @param DataSourceFactory $dataSourceFactory
     * @return JsonResponse
     */
    public function getUsers(DataSourceFactory $dataSourceFactory): JsonResponse
    {
        $request = Request::createFromGlobals();
        $start = $request->get('start', 0);
        $length = $request->get('length', DataTableResponse::DEFAULT_LENGTH);
        $draw = (int)$request->get('draw');
        $users = $this->getDataSource($dataSourceFactory)->getUsers($start, $length);
        return new DataTableResponse(
            $draw,
            (int)$users->get('total'),
            (int)$users->get('total'),
            $users->get('data')
        );
    }

    /**
     * @param DataSourceFactory $dataSourceFactory
     * @return \App\DataSources\AbstractDataSource
     */
    private function getDataSource(DataSourceFactory $dataSourceFactory): \App\DataSources\AbstractDataSource
    {
        return $dataSourceFactory->getDataSource(DataSourceFactory::REQRES_API_NAME)->setClient(
            new Client([
                'base_uri' => $this->container->getParameter('api_requeres_base_uri')
            ])
        );
    }
}