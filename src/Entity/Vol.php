<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Vol
 *
 * @ORM\Table(name="vol", indexes={@ORM\Index(name="fkcomvol", columns={"idcompagnie"}), @ORM\Index(name="fkvolavion", columns={"numserieavion"})})
 * @ORM\Entity (repositoryClass="App\Repository\VolRepository")
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
     * @ORM\Column(name="dateallervol", type="date", nullable=false)
     *@Assert\Range(
     *      min = "now",
     *      max = "last day of December "
     * )
     */
    private $dateallervol;

    /**
     * @var string
     *
     * @ORM\Column(name="tempallervol", type="string", length=30, nullable=false)
     */
    private $tempallervol;

    /**
     * @var \DateTime
     * @Assert\GreaterThan(
     *     value="0 days",
     *     message="date superieur a date debut"
     * )
     *
     * @ORM\Column(name="dateretourvol", type="date", nullable=false)
     * 
     * 
     */
    private $dateretourvol;

    /**
     * @var string
     * @Assert\NotBlank(message="destination  doit etre non vide")
     *
     * @ORM\Column(name="tempretourvol", type="string", length=100, nullable=false)
     */
    private $tempretourvol;

    /**
     * @var string
     *@Assert\NotBlank(message="destination  doit etre non vide")
     *@Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un nom au mini de 5 caracteres"
     *     )
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
     *@Assert\NotBlank(message="prix  doit etre non vide")
     *@Assert\Range(min=200, max=1000)
     * @ORM\Column(name="prixvol", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixvol;

    /**
     * @var string
     *@Assert\NotBlank(message="typevol  doit etre non vide")
     *@Assert\Length(
     *      min = 8,
     *      minMessage=" Entrer un nom au mini de 8 caracteres"
     *
     *     )
     *@ORM\Column(name="typevol", type="string", length=30, nullable=false)
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
     *   @ORM\JoinColumn(name="numserieavion", referencedColumnName="numserieavion")
     * })
     */
    private $numserieavion;

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

    public function getTempallervol(): ?string
    {
        return $this->tempallervol;
    }

    public function setTempallervol(string $tempallervol): self
    {
        $this->tempallervol = $tempallervol;

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

    public function getTempretourvol(): ?string
    {
        return $this->tempretourvol;
    }

    public function setTempretourvol(string $tempretourvol): self
    {
        $this->tempretourvol = $tempretourvol;

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

    public function getNumserieavion(): ?Avion
    {
        return $this->numserieavion;
    }

    public function setNumserieavion(?Avion $numserieavion): self
    {
        $this->numserieavion = $numserieavion;

        return $this;
    }
    public function __toString() {
        return $this->numvol;
    }
   


}
