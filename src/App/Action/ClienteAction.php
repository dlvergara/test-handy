<?php

namespace App\Action;

use App\Entity\Ciudades;
use App\Entity\Estados;
use app\models\Departamento;
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
                    $this->saveCliente( $params );
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

    function validate( &$params ) {
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
        } else {
            if( !is_numeric($params['ciudad']) ) {
                $this->saveCiudadEstado( $params );
            }
        }
        if( empty($params['cupo']) ) {
            $this->error['error']['cupo'] = 'Cupo es requerido';
        } else if( floatval($params['cupo']) <= 0 ) {
            $this->error['error']['cupo'] = 'Cupo es requerido';
        }

        return empty($this->error);
    }

    /**
     * @param $params
     */
    function saveCliente( $params ) {

        $cliente = new Cliente();
        $cliente->setNit(md5($params['nit']));
        $cliente->setDireccion($params['direccion']);
        $cliente->setNombre($params['nombre']);
        $cliente->setSaldoCupo($params['cupo']);
        $cliente->setCupo($params['cupo']);
        $cliente->setCiudadesIdCiudades($params['ciudad']);

        $this->entityManager->persist($cliente);
        $this->entityManager->flush($cliente);

        $return['id_cliente'] = $cliente->getId();
    }

    /**
     *
     * @param $params
     */
    function saveCiudadEstado( &$params ) {

        $departamento = new Estados();
        $departamento->setNombre($params['departamento']);
        $departamento->setPaisesIdPaises($params['pais']);
        $this->entityManager->persist($departamento);
        $this->entityManager->flush();

        $ciudad = new Ciudades();
        $ciudad->setNombre($params['ciudad']);
        $ciudad->setEstadosIdEstados($departamento->getId());
        $this->entityManager->persist($ciudad);
        $this->entityManager->flush();

        $params['ciudad'] = $ciudad->getId();
    }
}
