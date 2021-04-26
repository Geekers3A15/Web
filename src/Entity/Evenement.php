<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement", indexes={@ORM\Index(name="id_artiste", columns={"id_artiste"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\EvenementRepository")
 */
class Evenement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_event", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_event", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="titre est obligatoire")
     */

    private $titreEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="image_event", type="string", length=255, nullable=false)
     *
     */
    private $imageEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255, nullable=false)
     *  @Assert\NotBlank(message="categorie est obligatoire")
     */
    private $categorie;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     *  @Assert\NotBlank(message="description est obligatoire")
     */
    private $description;



    /**
     * @var string
     *
     * @ORM\Column(name="date_deb", type="string", length=255, nullable=false)
     *@Assert\NotBlank(message="date début est obligatoire")
     */
    private $dateDeb;

    /**
     * @var string
     *
     * @ORM\Column(name="date_fin", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="date fin est obligatoire")
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="localisation est obligatoire")
     */
    private $location;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_max", type="integer", nullable=false)
     * @Assert\NotBlank(message="nombre max est obligatoire")
     */
    private $nbMax;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     * @Assert\NotBlank(message="prix est obligatoire")
     */
    private $prix;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_artiste", referencedColumnName="id_user")
     * })
     */
    private $idArtiste;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User", inversedBy="idEvenement")
     * @ORM\JoinTable(name="participation",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_event", referencedColumnName="id_event")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_client", referencedColumnName="id_user")
     *   }
     * )
     */
    private $idClient;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idClient = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return int
     */
    public function getIdEvent(): ?int
    {
        return $this->idEvent;
    }

    /**
     * @param int $idEvent
     */
    public function setIdEvent(?int $idEvent): void
    {
        $this->idEvent = $idEvent;
    }

    /**
     * @return string
     */
    public function getTitreEvent(): ?string
    {
        return $this->titreEvent;
    }

    /**
     * @param string $titreEvent
     */
    public function setTitreEvent(?string $titreEvent): void
    {
        $this->titreEvent = $titreEvent;
    }

    /**
     * @return string
     */
    public function getImageEvent(): ?string
    {
        return $this->imageEvent;
    }

    /**
     * @param string $imageEvent
     */
    public function setImageEvent(?string $imageEvent): void
    {
        $this->imageEvent = $imageEvent;
    }

    /**
     * @return string
     */
    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    /**
     * @param string $categorie
     */
    public function setCategorie(?string $categorie): void
    {
        $this->categorie = $categorie;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }


    /**
     * @return string
     */
    public function getDateDeb(): ?string
    {
        return $this->dateDeb;
    }

    /**
     * @param string $dateDeb
     */
    public function setDateDeb($dateDeb): void
    {
        $this->dateDeb = $dateDeb;

    }

    /**
     * @return string
     */
    public function getDateFin(): ?string
    {
        return $this->dateFin;
    }

    /**
     * @param string $dateFin
     */
    public function setDateFin($dateFin): void
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return string
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation(?string $location): void
    {
        $this->location = $location;
    }

    /**
     * @return int
     */
    public function getNbMax(): ?int
    {
        return $this->nbMax;
    }

    /**
     * @param int $nbMax
     */
    public function setNbMax(?int $nbMax): void
    {
        $this->nbMax = $nbMax;
    }

    /**
     * @return int
     */
    public function getPrix(): ?int
    {
        return $this->prix;
    }

    /**
     * @param int $prix
     */
    public function setPrix(?int $prix): void
    {
        $this->prix = $prix;
    }

    /**
     * @return \User
     */
    public function getIdArtiste(): ?User
    {
        return $this->idArtiste;
    }

    /**
     * @param \User $idArtiste
     */
    public function setIdArtiste(?User $idArtiste): void
    {
        $this->idArtiste = $idArtiste;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $idClient
     */
    public function setIdClient($idClient): void
    {
        $this->idClient = $idClient;
    }

    public function addIdClient(User $idClient): self
    {
        if (!$this->idClient->contains($idClient)) {
            $this->idClient[] = $idClient;
        }

        return $this;
    }


    public function removeIdClient(User $idClient): self
    {
        $this->idClient->removeElement($idClient);

        return $this;
    }



}
