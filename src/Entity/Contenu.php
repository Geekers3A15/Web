<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contenu
 *
 * @ORM\Table(name="contenu", indexes={@ORM\Index(name="id_weblog", columns={"id_weblog"})})
 * @ORM\Entity
 */
class Contenu
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_contenu", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idContenu;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_contenu", type="string", length=255, nullable=false)
     */
    private $nomContenu;

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
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255, nullable=false)
     */
    private $statut;

    /**
     * @var \Weblog
     *
     * @ORM\ManyToOne(targetEntity="Weblog")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_weblog", referencedColumnName="id_web")
     * })
     */
    private $idWeblog;


}
