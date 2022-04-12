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

    public function __toString()
    {
        return $this->getNomsaison();

    }
}
