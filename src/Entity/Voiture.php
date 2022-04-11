<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Voiture
 *
 * @ORM\Table(name="voiture", indexes={@ORM\Index(name="fk_AgenceVoiture", columns={"idAgence"}), @ORM\Index(name="fk_saison", columns={"idSaison"})})
 * @ORM\Entity
 */
class Voiture
{
    /**
     * @var int
     *
     * @ORM\Column(name="matricule", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $matricule;

    /**
     * @var string
     *
     * @ORM\Column(name="marqueVoiture", type="string", length=50, nullable=false)
     */
    private $marquevoiture;

    /**
     * @var string
     *
     * @ORM\Column(name="photoVoiture", type="string", length=200, nullable=false)
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
     * @ORM\Column(name="nbChevaux", type="integer", nullable=false)
     */
    private $nbchevaux;

    /**
     * @var \Agencelocation
     *
     * @ORM\ManyToOne(targetEntity="Agencelocation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idAgence", referencedColumnName="idAgence")
     * })
     */
    private $idagence;

    /**
     * @var \Saison
     *
     * @ORM\ManyToOne(targetEntity="Saison")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idSaison", referencedColumnName="idSaison")
     * })
     */
    private $idsaison;

    public function getMatricule(): ?int
    {
        return $this->matricule;
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

    public function getNbchevaux(): ?int
    {
        return $this->nbchevaux;
    }

    public function setNbchevaux(int $nbchevaux): self
    {
        $this->nbchevaux = $nbchevaux;

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

    public function getIdsaison(): ?Saison
    {
        return $this->idsaison;
    }

    public function setIdsaison(?Saison $idsaison): self
    {
        $this->idsaison = $idsaison;

        return $this;
    }


}
