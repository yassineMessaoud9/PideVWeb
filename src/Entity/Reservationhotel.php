<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservationhotel
 *
 * @ORM\Table(name="reservationhotel", indexes={@ORM\Index(name="fk_user_ho", columns={"idU"}), @ORM\Index(name="FK_hotel_reservt", columns={"idhotel"})})
 * @ORM\Entity
 */
class Reservationhotel
{
    /**
     * @var int
     *
     * @ORM\Column(name="idReservationHotel", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreservationhotel;

    /**
     * @var string
     *
     * @ORM\Column(name="typeChambre", type="string", length=50, nullable=false)
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
     * @ORM\Column(name="datereservation", type="date", nullable=false)
     */
    private $datereservation;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrpersonne", type="integer", nullable=false)
     */
    private $nbrpersonne;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateallerReser", type="date", nullable=false)
     */
    private $dateallerreser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateretourReser", type="date", nullable=false)
     */
    private $dateretourreser;

    /**
     * @var \Hotel
     *
     * @ORM\ManyToOne(targetEntity="Hotel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idhotel", referencedColumnName="idhotel")
     * })
     */
    private $idhotel;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idU", referencedColumnName="idU")
     * })
     */
    private $idu;

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

    public function getIdhotel(): ?Hotel
    {
        return $this->idhotel;
    }

    public function setIdhotel(?Hotel $idhotel): self
    {
        $this->idhotel = $idhotel;

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


}
