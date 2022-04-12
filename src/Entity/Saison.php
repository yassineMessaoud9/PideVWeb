<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Saison
 *
 * @ORM\Table(name="saison")
 * @ORM\Entity
 */
class Saison
{
    /**
     * @var int
     *
     * @ORM\Column(name="idSaison", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsaison;

    /**
     * @var string
     *
     * @ORM\Column(name="nomSaison", type="string", length=100, nullable=false)
     */
    private $nomsaison;

    /**
     * @var float
     *
     * @ORM\Column(name="prixVoiture", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixvoiture;

    public function getIdsaison(): ?int
    {
        return $this->idsaison;
    }

    public function getNomsaison(): ?string
    {
        return $this->nomsaison;
    }

    public function setNomsaison(string $nomsaison): self
    {
        $this->nomsaison = $nomsaison;

        return $this;
    }

    public function getPrixvoiture(): ?float
    {
        return $this->prixvoiture;
    }

    public function setPrixvoiture(float $prixvoiture): self
    {
        $this->prixvoiture = $prixvoiture;

        return $this;
    }


}
