<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use yii\validators\DateValidator;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Doctrine\ORM\EntityManager;
use App\Entity\Estados;

class GetEstadosAction
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
        if( isset($params['pais']) && !empty($params['pais']) ) {
            $idPais = $params['pais'];
            $estados = $this->entityManager->getRepository(Estados::class )->findBy(['paises_id_paises'=>$idPais]);
        }

        return new JsonResponse($estados);
    }
}
