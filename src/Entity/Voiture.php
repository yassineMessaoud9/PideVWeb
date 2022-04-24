<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Voiture
 *
 * @ORM\Table(name="voiture", indexes={@ORM\Index(name="fk_Agencee", columns={"idAgence"})})
* @ORM\Entity (repositoryClass="App\Repository\VoitureRepository")
 */
class Voiture
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_voiture", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idVoiture;

    /**
     * @var int
     *  @Assert\NotBlank(message="matricule  doit etre non vide")
     * @Assert\Range(min=10000000, max=99999999)

     * 
     *
     * @ORM\Column(name="matricule", type="integer", nullable=false)
     */
    private $matricule;

    /**
     * @var string
     *@Assert\NotBlank(message="marque  doit etre non vide")
     * @ORM\Column(name="marqueVoiture", type="string", length=50, nullable=false)
     */
    private $marquevoiture;

    /**
     * @var string
     *@Assert\NotBlank(message="photo  doit etre non vide")
     * @ORM\Column(name="photoVoiture", type="string", length=50, nullable=false)
     */
    private $photovoiture;

    /**
     * @var int
     *
     * @ORM\Column(name="nbplace", type="integer", nullable=false)
     */
    private $nbplace;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrchevaux", type="integer", nullable=false)
     */
    private $nbrchevaux;

    /**
     * @var int
     *
     * @ORM\Column(name="tarif", type="integer", nullable=false)
     */
    private $tarif;

    /**
     * @var \Agencelocation
     *
     * @ORM\ManyToOne(targetEntity="Agencelocation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idAgence", referencedColumnName="idAgence")
     * })
     */
    private $idagence;

    public function getIdVoiture(): ?int
    {
        return $this->idVoiture;
    }

    public function getMatricule(): ?int
    {
        return $this->matricule;
    }

    public function setMatricule(int $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getMarquevoiture(): ?string
    {
        return $this->marquevoiture;
    }

    public function setMarquevoiture(string $marquevoiture): self
    {
        $this->marquevoiture = $marquevoiture;

        return $this;
    }

    public function getPhotovoiture(): ?string
    {
        return $this->photovoiture;
    }

    public function setPhotovoiture(string $photovoiture): self
    {
        $this->photovoiture = $photovoiture;

        return $this;
    }

    public function getNbplace(): ?int
    {
        return $this->nbplace;
    }

    public function setNbplace(int $nbplace): self
    {
        $this->nbplace = $nbplace;

        return $this;
    }

    public function getNbrchevaux(): ?int
    {
        return $this->nbrchevaux;
    }

    public function setNbrchevaux(int $nbrchevaux): self
    {
        $this->nbrchevaux = $nbrchevaux;

        return $this;
    }

    public function getTarif(): ?int
    {
        return $this->tarif;
    }

    public function setTarif(int $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getIdagence(): ?Agencelocation
    {
        return $this->idagence;
    }

    public function setIdagence(?Agencelocation $idagence): self
    {
        $this->idagence = $idagence;

        return $this;
    }
    // public function __toString()
    // {
    //     return $this->getIdagence();

    // }
    public function __toString()
    {
        return $this->marquevoiture;

    }


}
