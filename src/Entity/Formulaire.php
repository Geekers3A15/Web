<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formulaire
 *
 * @ORM\Table(name="formulaire", indexes={@ORM\Index(name="formulaire_ibfk_1", columns={"id_user_cli"}), @ORM\Index(name="id_user", columns={"id_user"})})
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
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="service_demande", type="text", length=65535, nullable=false)
     */
    private $serviceDemande;

    /**
     * @var int
     *
     * @ORM\Column(name="num_tel", type="integer", nullable=false)
     */
    private $numTel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="date_limite", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $dateLimite = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="date", nullable=false)
     */
    private $dateCreation;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_cli", referencedColumnName="id_user")
     * })
     */
    private $idUserCli;

    /**
     * @return int
     */
    public function getIdForm(): ?int
    {
        return $this->idForm;
    }

    /**
     * @param int $idForm
     */
    public function setIdForm(?int $idForm): void
    {
        $this->idForm = $idForm;
    }

    /**
     * @return int
     */
    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    /**
     * @param int $idUser
     */
    public function setIdUser(?int $idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * @return string
     */
    public function getServiceDemande(): ?string
    {
        return $this->serviceDemande;
    }

    /**
     * @param string $serviceDemande
     */
    public function setServiceDemande(?string $serviceDemande): void
    {
        $this->serviceDemande = $serviceDemande;
    }

    /**
     * @return int
     */
    public function getNumTel(): ?int
    {
        return $this->numTel;
    }

    /**
     * @param int $numTel
     */
    public function setNumTel(?int $numTel): void
    {
        $this->numTel = $numTel;
    }

    /**
     * @return string|null
     */
    public function getDateLimite(): ?string
    {
        return $this->dateLimite;
    }

    /**
     * @param string|null $dateLimite
     */
    public function setDateLimite(?string $dateLimite): void
    {
        $this->dateLimite = $dateLimite;
    }

    /**
     * @return string
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreation(): \DateTime
    {
        return $this->dateCreation;
    }

    /**
     * @param \DateTime $dateCreation
     */
    public function setDateCreation(\DateTime $dateCreation): void
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @return \User
     */
    public function getIdUserCli(): \User
    {
        return $this->idUserCli;
    }

    /**
     * @param \User $idUserCli
     */
    public function setIdUserCli(\User $idUserCli): void
    {
        $this->idUserCli = $idUserCli;
    }




}
