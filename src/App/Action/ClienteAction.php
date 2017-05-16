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
    public $error = [];

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $return = [];
        $params = $request->getParsedBody();
        if( !empty($params) ) {
            try{
                if( $this->validate($params) ) {
                    $cliente = new Cliente();
                    $cliente->setNit(md5($params['nit']));
                    $cliente->setDireccion($params['direccion']);
                    $cliente->setNombre($params['nombre']);
                    $cliente->setSaldoCupo($params['cupo']);
                    $cliente->setCupo($params['cupo']);

                    $this->entityManager->persist($cliente);
                    $this->entityManager->flush($cliente);
                    $return['id_cliente'] = $cliente->getId();
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

    function validate( $params ) {
        if( empty($params['nit']) ) {
            $this->error['error']['nit'] = 'Nit es requerido';
        }
        if( empty($params['nombre']) ) {
            $this->error['error']['nombre'] = 'Nombre es requerido';
        }
        if( empty($params['direccion']) ) {
            $this->error['error']['direccion'] = 'Direccion es requerido';
        }
        if( empty($params['telefono']) ) {
            $this->error['error']['telefono'] = 'Teléfono es requerido';
        }
        if( empty($params['pais']) ) {
            $this->error['error']['pais'] = 'País es requerido';
        }
        if( empty($params['departamento']) ) {
            $this->error['error']['departamento'] = 'Departamento es requerido';
        }
        if( empty($params['ciudad']) ) {
            $this->error['error']['ciudad'] = 'Ciudad es requerido';
        }
        if( empty($params['cupo']) ) {
            $this->error['error']['cupo'] = 'Cupo es requerido';
        } else if( floatval($params['cupo']) <= 0 ) {
            $this->error['error']['cupo'] = 'Cupo es requerido';
        }

        return empty($this->error);
    }
}
