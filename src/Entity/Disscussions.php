<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Disscussions
 *
 * @ORM\Table(name="disscussions", indexes={@ORM\Index(name="id_user_emt", columns={"id_user_emt"}), @ORM\Index(name="id_user_recp", columns={"id_user_recp"})})
 * @ORM\Entity
 */
class Disscussions
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_disc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDisc;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text", length=65535, nullable=false)
     */
    private $contenu;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_emt", referencedColumnName="id_user")
     * })
     */
    private $idUserEmt;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_recp", referencedColumnName="id_user")
     * })
     */
    private $idUserRecp;


}
