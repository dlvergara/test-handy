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
     * @ORM\GeneratedValue(strategy="IDENTITY")
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

}