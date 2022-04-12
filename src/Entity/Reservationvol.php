<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservationvol
 *
 * @ORM\Table(name="reservationvol", indexes={@ORM\Index(name="fkreseruser", columns={"idU"}), @ORM\Index(name="fkresevvol", columns={"numvol"})})
 * @ORM\Entity
 */
class Reservationvol
{
    /**
     * @var int
     *
     * @ORM\Column(name="idreservationvol", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreservationvol;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idU", referencedColumnName="idU")
     * })
     */
    private $idu;

    /**
     * @var \Vol
     *
     * @ORM\ManyToOne(targetEntity="Vol")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="numvol", referencedColumnName="numvol")
     * })
     */
    private $numvol;

    public function getIdreservationvol(): ?int
    {
        return $this->idreservationvol;
    }

    public function getIdu(): ?Utilisateur
    {
        return $this->idu;
    }

    public function setIdu(?Utilisateur $idu): self
    {
        $this->idu = $idu;

        return $this;
    }

    public function getNumvol(): ?Vol
    {
        return $this->numvol;
    }

    public function setNumvol(?Vol $numvol): self
    {
        $this->numvol = $numvol;

        return $this;
    }


}
