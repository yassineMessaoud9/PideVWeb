<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vol
 *
 * @ORM\Table(name="vol", indexes={@ORM\Index(name="fkcomvol", columns={"idcompagnie"}), @ORM\Index(name="fkvolavion", columns={"numserievol"})})
 * @ORM\Entity
 */
class Vol
{
    /**
     * @var int
     *
     * @ORM\Column(name="numvol", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numvol;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateallervol", type="datetime", nullable=false)
     */
    private $dateallervol;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateretourvol", type="datetime", nullable=false)
     */
    private $dateretourvol;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string", length=30, nullable=false)
     */
    private $destination;

    /**
     * @var string
     *
     * @ORM\Column(name="classvol", type="string", length=30, nullable=false)
     */
    private $classvol;

    /**
     * @var float
     *
     * @ORM\Column(name="prixvol", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixvol;

    /**
     * @var string
     *
     * @ORM\Column(name="typevol", type="string", length=30, nullable=false)
     */
    private $typevol;

    /**
     * @var \Compagnieaerienne
     *
     * @ORM\ManyToOne(targetEntity="Compagnieaerienne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idcompagnie", referencedColumnName="idcompagnie")
     * })
     */
    private $idcompagnie;

    /**
     * @var \Avion
     *
     * @ORM\ManyToOne(targetEntity="Avion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="numserievol", referencedColumnName="numserieavion")
     * })
     */
    private $numserievol;

    public function getNumvol(): ?int
    {
        return $this->numvol;
    }

    public function getDateallervol(): ?\DateTimeInterface
    {
        return $this->dateallervol;
    }

    public function setDateallervol(\DateTimeInterface $dateallervol): self
    {
        $this->dateallervol = $dateallervol;

        return $this;
    }

    public function getDateretourvol(): ?\DateTimeInterface
    {
        return $this->dateretourvol;
    }

    public function setDateretourvol(\DateTimeInterface $dateretourvol): self
    {
        $this->dateretourvol = $dateretourvol;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getClassvol(): ?string
    {
        return $this->classvol;
    }

    public function setClassvol(string $classvol): self
    {
        $this->classvol = $classvol;

        return $this;
    }

    public function getPrixvol(): ?float
    {
        return $this->prixvol;
    }

    public function setPrixvol(float $prixvol): self
    {
        $this->prixvol = $prixvol;

        return $this;
    }

    public function getTypevol(): ?string
    {
        return $this->typevol;
    }

    public function setTypevol(string $typevol): self
    {
        $this->typevol = $typevol;

        return $this;
    }

    public function getIdcompagnie(): ?Compagnieaerienne
    {
        return $this->idcompagnie;
    }

    public function setIdcompagnie(?Compagnieaerienne $idcompagnie): self
    {
        $this->idcompagnie = $idcompagnie;

        return $this;
    }

    public function getNumserievol(): ?Avion
    {
        return $this->numserievol;
    }

    public function setNumserievol(?Avion $numserievol): self
    {
        $this->numserievol = $numserievol;

        return $this;
    }


}
