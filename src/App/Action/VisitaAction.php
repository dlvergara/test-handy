<?php

namespace App\Action;

use App\Entity\Cliente;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Doctrine\ORM\EntityManager;
use App\Entity\Visita;

class VisitaAction
{
    private $entityManager;
    public $error = [];
    public $cliente;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $return     = [];
        $params     = $request->getParsedBody();

        if( !empty($params) ) {
            try{
                if( $this->validate($params) ) {
                    $this->save( $params );
                } else {
                    $return = $this->error;
                }
            } catch( \Exception $e ) {
                $return['error'][] = $e->getMessage();
            }
        } else {
            $return['error'][] = "Missing parameters";
        }
        return new JsonResponse($return);
    }

    /**
     * @param $params
     * @return bool
     */
    function validate( &$params ) {
        $porcentajeVisita = 0;

        if( empty($params['idCliente']) ) {
            $this->error['error']['cliente'] = 'No se ha seleccionado un cliente';
        } else {
            $cliente = $this->entityManager->getRepository(Cliente::class)->find($params['idCliente']);
            if( empty($cliente) ) {
                $this->error['error']['cliente'] = 'El cliente seleccionado no es valido';
            }
            $this->cliente = $cliente;
            $porcentajeVisita = $cliente->getPorcentajeVisita();
        }

        if( empty($params['fecha']) ) {
            $this->error['error']['fecha'] = 'Fecha es requerido';
        }
        if( empty($params['vendedor']) ) {
            $this->error['error']['vendedor'] = 'Vendedor es requerido';
        }
        if( empty($params['valor_neto']) ) {
            $this->error['error']['valor_neto'] = 'Valor Neto es requerido';
        }
        if( empty($params['valor_visita']) ) {
            $this->error['error']['valor_visita'] = 'Valor visita es requerido';
        } else {
            /*
            if( ($params['valor_neto'] * $porcentajeVisita) != floatval($params['valor_visita']) ) {
                $this->error['error']['valor_visita'] = 'Valor visita es inadecuado';
            }
            */
        }

        return empty($this->error);
    }

    /**
     * @param $params
     */
    function save( $params ) {

        $visita = new Visita();
        $visita->setFecha($params['fecha']);
        $visita->setClienteIdCliente( $this->cliente->getId() );
        $visita->setObservaciones($params['observaciones']);
        $visita->setValorNeto($params['valor_neto']);
        $visita->setValorVisita($params['valor_visita']);
        $visita->setVendedorIdVendedor($params['vendedor']);

        $this->entityManager->persist($visita);
        $this->entityManager->flush($visita);

        $return['id_visita'] = $visita->getId();
    }

}
