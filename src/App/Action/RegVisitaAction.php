<?php

namespace App\Action;

use App\Entity\Cliente;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\Plates\PlatesRenderer;
use Doctrine\ORM\EntityManager;
use App\Entity\Vendedor;

class RegVisitaAction
{
    private $router;
    private $entityManager;
    private $template;
    public $idCliente;

    public function __construct(Router\RouterInterface $router, Template\TemplateRendererInterface $template = null, EntityManager $entityManager)
    {
        $this->router   = $router;
        $this->template = $template;
        $this->entityManager = $entityManager;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $params = $request->getQueryParams();
        $vendedores = $this->entityManager->getRepository(Vendedor::class )->findAll();
        $data = [ 'title' => 'Registrar Cliente', 'vendedores' => $vendedores, 'cliente'=>null ];

        if( isset($params['idCliente']) ) {
            $cliente = $this->entityManager->getRepository(Cliente::class)->find($params['idCliente']);
            $data['cliente'] = $cliente->jsonSerialize();
        }
        return new HtmlResponse($this->template->render('app::reg-visita', $data));
    }
}
