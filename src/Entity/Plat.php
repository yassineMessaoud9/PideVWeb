<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @var string
     *
     * @ORM\Column(name="nomPlat", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="please enter the plat name")
     */
    private $nomplat;

    /**
     * @var float
     *
     * @ORM\Column(name="prixPlat", type="float", precision=10, scale=0, nullable=false)
     * @Assert\NotBlank(message="please enter your firstname")
     * @Assert\Type(
     *     type="float",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * 
     */
    private $prixplat;

    /**
     * @var string
     *
     * @ORM\Column(name="photoPlat", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="please enter plat photo")
     */
    private $photoplat;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=300, nullable=false)
     * @Assert\NotBlank(message="please enter description")
     */
    private $description;

    public function getIdplat(): ?int
    {
        return $this->idplat;
    }

    public function getNomplat(): ?string
    {
        return $this->nomplat;
    }

    public function setNomplat(string $nomplat): self
    {
        $this->nomplat = $nomplat;

        return $this;
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

    public function getPhotoplat() 
    {
        return $this->photoplat;
    }

    public function setPhotoplat($photoplat)
    {
        $this->photoplat = $photoplat;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function __toString()
    {
        return $this->nomplat;
    }

}
