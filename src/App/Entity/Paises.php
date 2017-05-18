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
 * @ORM\Table(name="Paises")
 */
class Paises
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id_paises", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    private $id_paises;

    /**
     * @ORM\Column(name="nombre", type="string", length=255)
     * @var string
     */
    private $nombre;

    /**
     * @ORM\Column(name="codigo", type="string", length=255)
     * @var string
     */
    private $codigo;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id_paises;
    }

    /**
     * @param int $id_paises
     * @return Paises
     */
    public function setId($id_paises)
    {
        $this->id_paises = $id_paises;
        return $this;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return htmlentities(utf8_encode($this->nombre));
    }

    /**
     * @param string $nombre
     * @return Paises
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param string $codigo
     * @return Paises
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
        return $this;
    }

}