<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservationrestaurant
 *
 * @ORM\Table(name="reservationrestaurant", indexes={@ORM\Index(name="fk_resres_user", columns={"idtourisme"}), @ORM\Index(name="fk_reser", columns={"idU"})})
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
     *
     * @ORM\Column(name="datereservationrestau", type="date", nullable=false)
     */
    private $datereservationrestau;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedebutres", type="datetime", nullable=false)
     */
    private $datedebutres;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefinres", type="datetime", nullable=false)
     */
    private $datefinres;

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
