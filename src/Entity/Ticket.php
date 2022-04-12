<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
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
     *
     * @ORM\Column(name="prixTicket", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixticket;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTicket", type="date", nullable=false)
     */
    private $dateticket;

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


}
