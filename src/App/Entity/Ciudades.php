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
 * @ORM\Table(name="ciudades")
 */
class Ciudades implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id_ciudades", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    private $id_ciudades;

    /**
     * @ORM\Column(name="nombre", type="string", length=70)
     * @var string
     */
    private $nombre;

    /**
     * @ORM\Column(name="estados_id_estados", type="integer" )
     * @var int
     */
    private $estados_id_estados;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id_ciudades;
    }

    /**
     * @param int $id
     * @return Ciudades
     */
    public function setId($id)
    {
        $this->id_ciudades = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return utf8_encode($this->nombre);
    }

    /**
     * @param string $nombre
     * @return Ciudades
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return int
     */
    public function getEstadosIdEstados()
    {
        return $this->estados_id_estados;
    }

    /**
     * @param int $estados_id_estados
     * @return Ciudades
     */
    public function setEstadosIdEstados($estados_id_estados)
    {
        $this->estados_id_estados = $estados_id_estados;
        return $this;
    }

    function jsonSerialize()
    {
        $data = [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
        ];

        return $data;
    }

}