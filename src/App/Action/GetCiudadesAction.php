<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use yii\validators\DateValidator;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Doctrine\ORM\EntityManager;
use App\Entity\Ciudades;

class GetCiudadesAction
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $estados = [];
        $params = $request->getQueryParams();
        if( isset($params['estado']) && !empty($params['estado']) ) {
            $idEstado = $params['estado'];
            $estados = $this->entityManager->getRepository(Ciudades::class )->findBy(['estados_id_estados'=>$idEstado]);
        }

        return new JsonResponse($estados);
    }
}
