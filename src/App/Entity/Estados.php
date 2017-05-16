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
 * @ORM\Table(name="estados")
 */
class Estados implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id_estados", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="nombre", type="string", length=45)
     * @var string
     */
    private $nombre;

    /**
     * @ORM\Column(name="paises_id_paises", type="integer" )
     * @var int
     */
    private $paises_id_paises;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Estados
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return utf8_encode(trim($this->nombre));
    }

    /**
     * @param string $nombre
     * @return Estados
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return int
     */
    public function getPaisesIdPaises()
    {
        return $this->paises_id_paises;
    }

    /**
     * @param int $paises_id_paises
     * @return Estados
     */
    public function setPaisesIdPaises($paises_id_paises)
    {
        $this->paises_id_paises = $paises_id_paises;
        return $this;
    }

    function jsonSerialize()
    {
        $data = [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'paises_id_paises' => $this->getPaisesIdPaises()
        ];
        if( empty($data['nombre']) ) {
            $data = array();
        }
        return json_encode($data);
    }
}