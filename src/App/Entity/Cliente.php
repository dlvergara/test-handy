<?php
/**
 * Created by PhpStorm.
 * User: David Leonardo V
 * Date: 14/05/2017
 * Time: 9:56 PM
 */
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Cliente")
 */
class Cliente
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id_cliente", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="nit", type="string", length=64)
     * @var string
     */
    private $nit;

    /**
     * @ORM\Column(name="nombre", type="string", length=45)
     * @var string
     */
    private $nombre;

    /**
     * @ORM\Column(name="direccion", type="string", length=255)
     * @var string
     */
    private $direccion;

    /**
     * @ORM\Column(name="cupo", type="decimal")
     * @var string
     */
    private $cupo;

    /**
     * @ORM\Column(name="saldo_cupo", type="decimal")
     * @var string
     */
    private $saldo_cupo;

    /**
     * @ORM\Column(name="procentaje_visita", type="decimal")
     * @var string
     */
    private $procentaje_visita;

    /**
     * @ORM\Column(name="ciudades_id_ciudades", type="integer" )
     * @var integer
     */
    private $ciudades_id_ciudades;

    /**
     * @return mixed
     */
    public function getCiudadesIdCiudades()
    {
        return $this->ciudades_id_ciudades;
    }

    /**
     * @param mixed $ciudades_id_ciudades
     * @return Cliente
     */
    public function setCiudadesIdCiudades($ciudades_id_ciudades)
    {
        $this->ciudades_id_ciudades = $ciudades_id_ciudades;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Cliente
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNit()
    {
        return $this->nit;
    }

    /**
     * @param string $nit
     * @return Cliente
     */
    public function setNit($nit)
    {
        $this->nit = $nit;
        return $this;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     * @return Cliente
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param string $direccion
     * @return Cliente
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
        return $this;
    }

    /**
     * @return string
     */
    public function getCupo()
    {
        return $this->cupo;
    }

    /**
     * @param string $cupo
     * @return Cliente
     */
    public function setCupo($cupo)
    {
        $this->cupo = $cupo;
        return $this;
    }

    /**
     * @return string
     */
    public function getSaldoCupo()
    {
        return $this->saldo_cupo;
    }

    /**
     * @param string $saldo_cupo
     * @return Cliente
     */
    public function setSaldoCupo($saldo_cupo)
    {
        $this->saldo_cupo = $saldo_cupo;
        return $this;
    }

    /**
     * @return string
     */
    public function getProcentajeVisita()
    {
        return $this->procentaje_visita;
    }

    /**
     * @param string $procentaje_visita
     * @return Cliente
     */
    public function setProcentajeVisita($procentaje_visita)
    {
        $this->procentaje_visita = $procentaje_visita;
        return $this;
    }

}