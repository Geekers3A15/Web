<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Weblog
 *
 * @ORM\Table(name="weblog", indexes={@ORM\Index(name="weblogfk", columns={"id_artiste"})})
 * @ORM\Entity
 */
class Weblog
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_web", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=20, nullable=false)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text", length=65535, nullable=false)
     */
    private $contenu;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=false)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="video", type="string", length=255, nullable=false)
     */
    private $video;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_artiste", referencedColumnName="id_user")
     * })
     */
    private $idArtiste;


}
