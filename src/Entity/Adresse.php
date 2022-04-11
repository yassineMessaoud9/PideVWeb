<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adresse
 *
 * @ORM\Table(name="adresse")
 * @ORM\Entity
 */
class Adresse
{
    /**
     * @var int
     *
     * @ORM\Column(name="idadresse", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idadresse;

    /**
     * @var string
     *
     * @ORM\Column(name="paysadresse", type="string", length=30, nullable=false)
     */
    private $paysadresse;

    /**
     * @var string
     *
     * @ORM\Column(name="rueadresse", type="string", length=30, nullable=false)
     */
    private $rueadresse;

    /**
     * @var int
     *
     * @ORM\Column(name="contactadresse", type="integer", nullable=false)
     */
    private $contactadresse;

    public function getIdadresse(): ?int
    {
        return $this->idadresse;
    }

    public function getPaysadresse(): ?string
    {
        return $this->paysadresse;
    }

    public function setPaysadresse(string $paysadresse): self
    {
        $this->paysadresse = $paysadresse;

        return $this;
    }

    public function getRueadresse(): ?string
    {
        return $this->rueadresse;
    }

    public function setRueadresse(string $rueadresse): self
    {
        $this->rueadresse = $rueadresse;

        return $this;
    }

    public function getContactadresse(): ?int
    {
        return $this->contactadresse;
    }

    public function setContactadresse(int $contactadresse): self
    {
        $this->contactadresse = $contactadresse;

        return $this;
    }


}
