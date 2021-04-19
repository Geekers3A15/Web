<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formulaire
 *
 * @ORM\Table(name="formulaire", indexes={@ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity
 */
class Formulaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_form", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idForm;

    /**
     * @var string
     *
     * @ORM\Column(name="service demande", type="text", length=65535, nullable=false)
     */
    private $serviceDemande;

    /**
     * @var int
     *
     * @ORM\Column(name="num_tel", type="integer", nullable=false)
     */
    private $numTel;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_limite", type="date", nullable=false)
     */
    private $dateLimite;

    /**
     * @var string
     *
     * @ORM\Column(name="type_pay", type="string", length=255, nullable=false)
     */
    private $typePay;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
    private $idUser;


}
