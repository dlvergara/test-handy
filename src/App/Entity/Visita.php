<?php
/**
 * Created by PhpStorm.
 * User: David Leonardo V
 * Date: 14/05/2017
 * Time: 9:56 PM
 */
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\JsonSerializable;

/**
 * @ORM\Entity
 * @ORM\Table(name="visita")
 */
class Visita implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id_visita", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="fecha", type="string", length=22)
     * @var string
     */
    private $fecha;

    /**
     * @ORM\Column(name="vendedor_id_vendedor", type="integer" )
     * @var int
     */
    private $vendedor_id_vendedor;

    /**
     * @ORM\Column(name="cliente_id_cliente", type="integer" )
     * @var int
     */
    private $cliente_id_cliente;

    /**
     * @ORM\Column(name="valor_neto", type="decimal")
     * @var int
     */
    private $valor_neto;

    /**
     * @ORM\Column(name="valor_visita", type="decimal")
     * @var int
     */
    private $valor_visita;

    /**
     * @ORM\Column(name="observaciones", type="string")
     * @var string
     */
    private $observaciones;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Visita
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param string $fecha
     * @return Visita
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
        return $this;
    }

    /**
     * @return int
     */
    public function getVendedorIdVendedor()
    {
        return $this->vendedor_id_vendedor;
    }

    /**
     * @param int $vendedor_id_vendedor
     * @return Visita
     */
    public function setVendedorIdVendedor($vendedor_id_vendedor)
    {
        $this->vendedor_id_vendedor = $vendedor_id_vendedor;
        return $this;
    }

    /**
     * @return int
     */
    public function getClienteIdCliente()
    {
        return $this->cliente_id_cliente;
    }

    /**
     * @param int $cliente_id_cliente
     * @return Visita
     */
    public function setClienteIdCliente($cliente_id_cliente)
    {
        $this->cliente_id_cliente = $cliente_id_cliente;
        return $this;
    }

    /**
     * @return int
     */
    public function getValorNeto()
    {
        return $this->valor_neto;
    }

    /**
     * @param int $valor_neto
     * @return Visita
     */
    public function setValorNeto($valor_neto)
    {
        $this->valor_neto = $valor_neto;
        return $this;
    }

    /**
     * @return int
     */
    public function getValorVisita()
    {
        return $this->valor_visita;
    }

    /**
     * @param int $valor_visita
     * @return Visita
     */
    public function setValorVisita($valor_visita)
    {
        $this->valor_visita = $valor_visita;
        return $this;
    }

    /**
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * @param string $observaciones
     * @return Visita
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
        return $this;
    }

    function jsonSerialize()
    {
        $data = [
            'id' => $this->getId(),
            'fecha'=>$this->getFecha(),
            'valor_neto' => $this->getValorNeto(),
            'valor_visita' => $this->getValorVisita(),
            'vendedor' => $this->getVendedorIdVendedor(),
            'cliente' => $this->getClienteIdCliente(),
        ];
        return $data;
    }
}