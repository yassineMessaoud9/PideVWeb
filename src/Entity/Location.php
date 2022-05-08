<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Location
 *
 * @ORM\Table(name="location", indexes={@ORM\Index(name="fk_idAgence", columns={"idAgence"}), @ORM\Index(name="fk_LocationUser", columns={"idU"}), @ORM\Index(name="fk_matricule", columns={"matricule"})})
 * @ORM\Entity
 */
class Location
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
     * @var int
     *
     * @ORM\Column(name="nbHeures", type="integer", nullable=false)
     */
    private $nbheures;

    /**
     * @var float
     *
     * @ORM\Column(name="prixLocation", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixlocation;

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
     *   @ORM\JoinColumn(name="matricule", referencedColumnName="matricule")
     * })
     */
    private $matricule;

    /**
     * @var \Agencelocation
     *
     * @ORM\ManyToOne(targetEntity="Agencelocation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idAgence", referencedColumnName="idAgence")
     * })
     */
    private $idagence;

    public function getIdlocation(): ?int
    {
        return $this->idlocation;
    }

    public function getNbheures(): ?int
    {
        return $this->nbheures;
    }

    public function setNbheures(int $nbheures): self
    {
        $this->nbheures = $nbheures;

        return $this;
    }

    public function getPrixlocation(): ?float
    {
        return $this->prixlocation;
    }

    public function setPrixlocation(float $prixlocation): self
    {
        $this->prixlocation = $prixlocation;

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

    public function getMatricule(): ?Voiture
    {
        return $this->matricule;
    }

    public function setMatricule(?Voiture $matricule): self
    {
        $this->matricule = $matricule;

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


}
