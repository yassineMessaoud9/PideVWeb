<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plat
 *
 * @ORM\Table(name="plat")
 * @ORM\Entity
 */
class Plat
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPlat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idplat;

    /**
     * @var float
     *
     * @ORM\Column(name="prixPlat", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixplat;

    /**
     * @var string
     *
     * @ORM\Column(name="photoPlat", type="string", length=300, nullable=false)
     */
    private $photoplat;

    /**
     * @var int
     *
     * @ORM\Column(name="numRestaurant", type="integer", nullable=false)
     */
    private $numrestaurant;

    public function getIdplat(): ?int
    {
        return $this->idplat;
    }

    public function getPrixplat(): ?float
    {
        return $this->prixplat;
    }

    public function setPrixplat(float $prixplat): self
    {
        $this->prixplat = $prixplat;

        return $this;
    }

    public function getPhotoplat(): ?string
    {
        return $this->photoplat;
    }

    public function setPhotoplat(string $photoplat): self
    {
        $this->photoplat = $photoplat;

        return $this;
    }

    public function getNumrestaurant(): ?int
    {
        return $this->numrestaurant;
    }

    public function setNumrestaurant(int $numrestaurant): self
    {
        $this->numrestaurant = $numrestaurant;

        return $this;
    }


}
