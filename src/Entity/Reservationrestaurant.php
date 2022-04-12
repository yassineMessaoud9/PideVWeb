<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Reservationrestaurant
 *
 * @ORM\Table(name="reservationrestaurant", indexes={@ORM\Index(name="fk_user_res", columns={"idU"}), @ORM\Index(name="fk_reshotell_restau", columns={"idrestau"})})
 * @ORM\Entity
 */
class Reservationrestaurant
{
    /**
     * @var int
     *
     * @ORM\Column(name="idreservationrestau", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreservationrestau;

    /**
     * @var \DateTime
     * @ORM\Column(name="datereservationrestau", type="date", nullable=false)
     */
    private $datereservationrestau;

    /**
     * @var \DateTime
      * @Assert\DateTime(format="Y/m/d")
     * @Assert\LessThanOrEqual(
     *     value="0 days",
     *     message="should today's date or less"
    * )
     * @ORM\Column(name="datedebutres", type="date", nullable=false)
     */
    private $datedebutres;

    /**
     * @var \DateTime
     * @Assert\DateTime(format="Y/m/d")
     * @Assert\GreaterThan(
     *     value="0 days",
     *     message="today's date or more"
     * )
     * @ORM\Column(name="datefinres", type="date", nullable=false)
     */
    private $datefinres;

    /**
     * @var \Restaurant
     *
     * @ORM\ManyToOne(targetEntity="Restaurant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idrestau", referencedColumnName="idrestau")
     * })
     */
    private $idrestau;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idU", referencedColumnName="idU")
     * })
     */
    private $idu;

    public function getIdreservationrestau(): ?int
    {
        return $this->idreservationrestau;
    }

    public function getDatereservationrestau(): ?\DateTimeInterface
    {
        return $this->datereservationrestau;
    }

    public function setDatereservationrestau(\DateTimeInterface $datereservationrestau): self
    {
        $this->datereservationrestau = $datereservationrestau;

        return $this;
    }

    public function getDatedebutres(): ?\DateTimeInterface
    {
        return $this->datedebutres;
    }

    public function setDatedebutres(\DateTimeInterface $datedebutres): self
    {
        $this->datedebutres = $datedebutres;

        return $this;
    }

    public function getDatefinres(): ?\DateTimeInterface
    {
        return $this->datefinres;
    }

    public function setDatefinres(\DateTimeInterface $datefinres): self
    {
        $this->datefinres = $datefinres;

        return $this;
    }

    public function getIdrestau(): ?Restaurant
    {
        return $this->idrestau;
    }

    public function setIdrestau(?Restaurant $idrestau): self
    {
        $this->idrestau = $idrestau;

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
    public function __toString()
    {
        return $this->datefinres;

    }
   
}
