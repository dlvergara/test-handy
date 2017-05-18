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
 * @ORM\Table(name="vendedor")
 */
class Vendedor implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id_vendedor", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="nombre", type="string", length=70)
     * @var string
     */
    private $nombre;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
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