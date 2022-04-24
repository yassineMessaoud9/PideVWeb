<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * Locationvoiture
 *
 * @ORM\Table(name="locationvoiture", indexes={@ORM\Index(name="matricule", columns={"id_voiture"}), @ORM\Index(name="fk_User", columns={"idU"}), @ORM\Index(name="fk_sais", columns={"id_saison"})})
 * @ORM\Entity (repositoryClass="App\Repository\LocationvoitureRepository")
 * 
 */
class Locationvoiture
{
    /**
     * @var int
     *
     * @ORM\Column(name="idLocation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlocation;

    /**
     * @var \DateTime
     * @Assert\GreaterThan(
     *     value="0 days",
     *     message="today's date or more"
     * )
     * @ORM\Column(name="datedebutLocation", type="date", nullable=false)
     */
    private $datedebutlocation;

    /**
     * @var \DateTime
     * @Assert\GreaterThan(
     *     value="0 days",
     *     message="today's date or more"
     * )
   
     *
     * @ORM\Column(name="datefinLocation", type="date", nullable=false)
     */
    private $datefinlocation;

    /**
     * @var \DateTime
     * @ORM\Column(name="dateLocation", type="datetime", nullable=false)
     */
    private $datelocation;

    /**
     * @var float
 
     * @ORM\Column(name="montant", type="float", nullable=false)
     */
    private $montant;

    /**
     * @var \Saison
     *
     * @ORM\ManyToOne(targetEntity="Saison")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_saison", referencedColumnName="idSaison")
     * })
     */
    private $idSaison;

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
     * @var \Voiture
     *
     * @ORM\ManyToOne(targetEntity="Voiture")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="matricule", referencedColumnName="id_voiture")
     * })
     */
    private $id_voiture;

    public function getIdlocation(): ?int
    {
        return $this->idlocation;
    }

    public function getDatedebutlocation(): ?\DateTimeInterface
    {
        return $this->datedebutlocation;
    }

    public function setDatedebutlocation(\DateTimeInterface $datedebutlocation): self
    {
        $this->datedebutlocation = $datedebutlocation;

        return $this;
    }

    public function getDatefinlocation(): ?\DateTimeInterface
    {
        return $this->datefinlocation;
    }

    public function setDatefinlocation(\DateTimeInterface $datefinlocation): self
    {
        $this->datefinlocation = $datefinlocation;

        return $this;
    }

    public function getDatelocation(): ?\DateTimeInterface
    {
        return $this->datelocation;
    }

    public function setDatelocation(\DateTimeInterface $datelocation): self
    {
        $this->datelocation = $datelocation;

        return $this;
    }

    public function getMontant(): ?float
    { 
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getIdSaison(): ?Saison
    {
        return $this->idSaison;
    }

    public function setIdSaison(?Saison $idSaison): self
    {
        $this->idSaison = $idSaison;

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

    public function getIdVoiture(): ?Voiture
    {
        return $this->id_voiture;
    }
    
    public function setIdVoiture(?Voiture $idVoiture): self
    {
        $this->id_voiture = $idVoiture;

        return $this;
    }

    

    
    public function __toString()
    {
        return $this->montant;

    }

}
