<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\Plates\PlatesRenderer;
use Doctrine\ORM\EntityManager;
use App\Entity\Paises;

class ListadoClienteAction
{
    private $router;
    private $entityManager;
    private $template;

    public function __construct(Router\RouterInterface $router, Template\TemplateRendererInterface $template = null, EntityManager $entityManager)
    {
        $this->router   = $router;
        $this->template = $template;
        $this->entityManager = $entityManager;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $clientes = $this->entityManager->getRepository(Clientes::class )->findAll();
        $data = [ 'title' => 'Registrar Cliente', 'clientes' => $clientes ];

        return new HtmlResponse($this->template->render('app::listado-cliente', $data));
    }
}
