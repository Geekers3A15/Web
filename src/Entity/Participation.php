<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation", indexes={@ORM\Index(name="fk", columns={"id_client", "id_event"}), @ORM\Index(name="IDX_AB55E24FE173B1B8", columns={"id_client"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ParticipationRepository")
 */
class Participation
{


    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_client", referencedColumnName="id_user")
     * })
     */
    private $idClient;

    /**
     * @var \Evenement
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_event", referencedColumnName="id_event")
     * })
     */
    private $idEvent;





    /**
     * @return \User
     */
    public function getIdClient(): User
    {
        return $this->idClient;
    }

    /**
     * @param \User $idClient
     */
    public function setIdClient(User $idClient): void
    {
        $this->idClient = $idClient;
    }

    /**
     * @return \Evenement
     */
    public function getIdEvent(): Evenement
    {
        return $this->idEvent;
    }

    /**
     * @param \Evenement $idEvent
     */
    public function setIdEvent(Evenement $idEvent): void
    {
        $this->idEvent = $idEvent;
    }



}
