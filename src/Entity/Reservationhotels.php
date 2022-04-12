<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Reservationhotels
 *
 * @ORM\Table(name="reservationhotels", indexes={@ORM\Index(name="fk_hoo", columns={"idU"}), @ORM\Index(name="fk_hooU", columns={"idhotel"})})
 * @ORM\Entity
 */
class Reservationhotels
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
     *  @Assert\NotBlank(message=" typechambre doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un nom au mini de 5 caracteres"
     *
     *     )
     *
     * @ORM\Column(name="typeChambre", type="string", length=50, nullable=false)
     */
    private $typechambre;

    /**
     * @var int
      * @Assert\NotBlank(message="nbrnuit  doit etre non vide")
     * @Assert\Range(min=1, max=9999, minMessage=" Entrer un nbruit superieur à 0")
     *  minMessage=" Entrer un nbruit superieur à 5"

     * @ORM\Column(name="nbrnuit", type="integer", nullable=false)
     */
    private $nbrnuit;

    /**
     * @var \DateTime
     * @ORM\Column(name="datereservation", type="date", nullable=false)
     */
    private $datereservation;

    /**
     * @var int
     * @Assert\NotBlank(message="nbr personne  doit etre non vide")
     * @Assert\Range(min=1, max=9999)
     * @ORM\Column(name="nbrpersonne", type="integer", nullable=false)
     */
    private $nbrpersonne;

    /**
     * @var \DateTime
      * @Assert\DateTime(format="Y/m/d")
     * @Assert\LessThanOrEqual(
     *     value="0 days",
     *     message="should today's date or less"
    * )
     * @ORM\Column(name="dateallerReser", type="date", nullable=false)
     */
    private $dateallerreser;

    /**
     * @var \DateTime
     * @Assert\DateTime(format="Y/m/d")
     * @Assert\GreaterThan(
     *     value="0 days",
     *     message="today's date or more"
     * )
     * @ORM\Column(name="dateretourReser", type="date", nullable=false)
     */
    private $dateretourreser;

    /**
     * @var int
     *
     * @ORM\Column(name="idU", type="integer", nullable=false)
     */
    private $idu;

    /**
     * @var \Hotel
     *
     * @ORM\ManyToOne(targetEntity="Hotel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idhotel", referencedColumnName="idhotel")
     * })
     */
    private $idhotel;

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

    public function getIdu(): ?int
    {
        return $this->idu;
    }

    public function setIdu(int $idu): self
    {
        $this->idu = $idu;

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
    public function __toString()
    {
        return $this-> getIdreservationhotel();

    }

}
