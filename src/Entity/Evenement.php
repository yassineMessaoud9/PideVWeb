<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity
 */
class Evenement
{
    /**
     * @var int
     *
     * @ORM\Column(name="idEve", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ideve;

    /**
     * @var string
     *
     * @ORM\Column(name="paysEve", type="string", length=50, nullable=false)
     */
    private $payseve;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEve", type="date", nullable=false)
     */
    private $dateeve;

    /**
     * @var string
     *
     * @ORM\Column(name="addressEve", type="string", length=50, nullable=false)
     */
    private $addresseve;

    /**
     * @var string
     *
     * @ORM\Column(name="typeEve", type="string", length=50, nullable=false)
     */
    private $typeeve;

    /**
     * @var string
     *
     * @ORM\Column(name="photoEve", type="string", length=50, nullable=false)
     */
    private $photoeve;

    public function getIdeve(): ?int
    {
        return $this->ideve;
    }

    public function getPayseve(): ?string
    {
        return $this->payseve;
    }

    public function setPayseve(string $payseve): self
    {
        $this->payseve = $payseve;

        return $this;
    }

    public function getDateeve(): ?\DateTimeInterface
    {
        return $this->dateeve;
    }

    public function setDateeve(\DateTimeInterface $dateeve): self
    {
        $this->dateeve = $dateeve;

        return $this;
    }

    public function getAddresseve(): ?string
    {
        return $this->addresseve;
    }

    public function setAddresseve(string $addresseve): self
    {
        $this->addresseve = $addresseve;

        return $this;
    }

    public function getTypeeve(): ?string
    {
        return $this->typeeve;
    }

    public function setTypeeve(string $typeeve): self
    {
        $this->typeeve = $typeeve;

        return $this;
    }

    public function getPhotoeve(): ?string
    {
        return $this->photoeve;
    }

    public function setPhotoeve(string $photoeve): self
    {
        $this->photoeve = $photoeve;

        return $this;
    }


}
