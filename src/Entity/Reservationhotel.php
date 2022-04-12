<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservationhotel
 *
 * @ORM\Table(name="reservationhotel", indexes={@ORM\Index(name="fk_reserhotel_user", columns={"idU"}), @ORM\Index(name="fk_reshotel_tourisme", columns={"idtourisme"})})
 * @ORM\Entity
 */
class Reservationhotel
{
    /**
     * @var int
     *
     * @ORM\Column(name="idreservationHotel", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreservationhotel;

    /**
     * @var string
     *
     * @ORM\Column(name="typechambre", type="string", length=50, nullable=false)
     */
    private $typechambre;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrnuit", type="integer", nullable=false)
     */
    private $nbrnuit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datereservation", type="date", nullable=false, options={"default"="current_timestamp()"})
     */
    private $datereservation = 'current_timestamp()';

    /**
     * @var int
     *
     * @ORM\Column(name="nbrpersonne", type="integer", nullable=false)
     */
    private $nbrpersonne;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateallerReser", type="datetime", nullable=false)
     */
    private $dateallerreser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateretourReser", type="datetime", nullable=false)
     */
    private $dateretourreser;

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
     * @var \Tourismeetablissement
     *
     * @ORM\ManyToOne(targetEntity="Tourismeetablissement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idtourisme", referencedColumnName="idtourisme")
     * })
     */
    private $idtourisme;

    public function getIdreservationhotel(): ?int
    {
        return $this->idreservationhotel;
    }

    public function getTypechambre(): ?string
    {
        return $this->typechambre;
    }

    public function setTypechambre(string $typechambre): self
    {
        $this->typechambre = $typechambre;

        return $this;
    }

    public function getNbrnuit(): ?int
    {
        return $this->nbrnuit;
    }

    public function setNbrnuit(int $nbrnuit): self
    {
        $this->nbrnuit = $nbrnuit;

        return $this;
    }

    public function getDatereservation(): ?\DateTimeInterface
    {
        return $this->datereservation;
    }

    public function setDatereservation(\DateTimeInterface $datereservation): self
    {
        $this->datereservation = $datereservation;

        return $this;
    }

    public function getNbrpersonne(): ?int
    {
        return $this->nbrpersonne;
    }

    public function setNbrpersonne(int $nbrpersonne): self
    {
        $this->nbrpersonne = $nbrpersonne;

        return $this;
    }

    public function getDateallerreser(): ?\DateTimeInterface
    {
        return $this->dateallerreser;
    }

    public function setDateallerreser(\DateTimeInterface $dateallerreser): self
    {
        $this->dateallerreser = $dateallerreser;

        return $this;
    }

    public function getDateretourreser(): ?\DateTimeInterface
    {
        return $this->dateretourreser;
    }

    public function setDateretourreser(\DateTimeInterface $dateretourreser): self
    {
        $this->dateretourreser = $dateretourreser;

        return $this;
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

    public function getIdtourisme(): ?Tourismeetablissement
    {
        return $this->idtourisme;
    }

    public function setIdtourisme(?Tourismeetablissement $idtourisme): self
    {
        $this->idtourisme = $idtourisme;

        return $this;
    }


}
