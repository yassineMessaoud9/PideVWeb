<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compagnieaerienne
 *
 * @ORM\Table(name="compagnieaerienne", indexes={@ORM\Index(name="fk_comadr", columns={"idadresse"})})
 * @ORM\Entity
 */
class Compagnieaerienne
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcompagnie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcompagnie;

    /**
     * @var string
     *
     * @ORM\Column(name="nomcompagnie", type="string", length=30, nullable=false)
     */
    private $nomcompagnie;

    /**
     * @var \Adresse
     *
     * @ORM\ManyToOne(targetEntity="Adresse")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idadresse", referencedColumnName="idadresse")
     * })
     */
    private $idadresse;

    public function getIdcompagnie(): ?int
    {
        return $this->idcompagnie;
    }

    public function getNomcompagnie(): ?string
    {
        return $this->nomcompagnie;
    }

    public function setNomcompagnie(string $nomcompagnie): self
    {
        $this->nomcompagnie = $nomcompagnie;

        return $this;
    }

    public function getIdadresse(): ?Adresse
    {
        return $this->idadresse;
    }

    public function setIdadresse(?Adresse $idadresse): self
    {
        $this->idadresse = $idadresse;

        return $this;
    }


}
