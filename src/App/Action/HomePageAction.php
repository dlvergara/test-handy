<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\Plates\PlatesRenderer;
use Zend\Expressive\Twig\TwigRenderer;
use Zend\Expressive\ZendView\ZendViewRenderer;
use Doctrine\ORM\EntityManager;
use App\Entity\Cliente;
use App\Entity\Ciudades;
use Doctrine\ORM\Query\Expr\Join;

class HomePageAction
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
        $conteoVisitas = 100;
        $nuevosClientes = 100;

        $conteoPaises = $this->getConteoPaises();
        $conteoCiudades = $this->getConteoCiudades();

        $data = [
            'conteoVisitas'  => $conteoVisitas,
            'nuevosClientes' => $nuevosClientes,
            'conteoPaises'   => $conteoPaises,
            'conteoCiudades' => $conteoCiudades
        ];

        return new HtmlResponse($this->template->render('app::home-page', $data));
    }

    function getConteoCiudades() {
        $return = [];
        $qb = $this->entityManager->createQueryBuilder()
            ->select('ciu.nombre as y, COUNT(1) as item1')
            ->from('App\Entity\Cliente', 'cli')
            ->innerJoin('App\Entity\Ciudades', 'ciu', Join::WITH, 'cli.ciudades_id_ciudades = ciu.id_ciudades')
            ->groupBy('ciu.nombre');
        $data = $qb->getQuery()->getResult();

        foreach ($data as $key => $res){
            $return[$key]['y'] = utf8_encode($res['y']);
            $return[$key]['item1'] = utf8_encode($res['item1']);
        }

        return $return;
    }

    function getConteoPaises() {
        $qb = $this->entityManager->createQueryBuilder()
            ->select('pai.codigo, COUNT(1) as num_ciudades')
            ->from('App\Entity\Cliente', 'cli')
            ->innerJoin('App\Entity\Ciudades', 'ciu', Join::WITH, 'cli.ciudades_id_ciudades = ciu.id_ciudades')
            ->innerJoin('App\Entity\Estados', 'est', Join::WITH, 'ciu.estados_id_estados = est.id_estados')
            ->innerJoin('App\Entity\Paises', 'pai', Join::WITH, 'est.paises_id_paises = pai.id_paises')
            ->groupBy('pai.codigo');
        $data = $qb->getQuery()->getResult();

        return $data;
    }
}
