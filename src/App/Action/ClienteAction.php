<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Doctrine\ORM\EntityManager;
use App\Entity\Cliente;

class ClienteAction
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
var_dump( $request->getBody()->getContents() ); exit;
        return new JsonResponse($this->entityManager->find(Cliente::class, 1));
    }
}
