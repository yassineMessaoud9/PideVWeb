<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket", indexes={@ORM\Index(name="fk_idevetick", columns={"idEve"})})
 * @ORM\Entity
 */
class Ticket
{
    /**
     * @var int
     *
     * @ORM\Column(name="idTicket", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idticket;

    /**
     * @var float
     * @Assert\NotBlank(message=" no free tickets mate")
     * @Assert\Type(type="float", message="List price must be a numeric value")
     * @Assert\GreaterThanOrEqual(message="list price must be no less than zero", value = 0)
     * @ORM\Column(name="prixTicket", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixticket;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message = "La date de début doit être saisie.")
     * @ORM\Column(name="dateTicket", type="date", nullable=false)
     */
    private $dateticket;

    /**
     * @var \Evenement
     * @Assert\NotBlank(message="Choisir le nom de l'evenement svp")
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEve", referencedColumnName="idEve")
     * })
     */
    private $ideve;

    public function getIdticket(): ?int
    {
        return $this->idticket;
    }

    public function getPrixticket(): ?float
    {
        return $this->prixticket;
    }

    public function setPrixticket(float $prixticket): self
    {
        $this->prixticket = $prixticket;

        return $this;
    }

    public function getDateticket(): ?\DateTimeInterface
    {
        return $this->dateticket;
    }

    public function setDateticket(\DateTimeInterface $dateticket): self
    {
        $this->dateticket = $dateticket;

        return $this;
    }

    public function getIdeve(): ?Evenement
    {
        return $this->ideve;
    }

    public function setIdeve(?Evenement $ideve): self
    {
        $this->ideve = $ideve;

        return $this;
    }


}
