<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
<<<<<<< HEAD
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
=======
>>>>>>> origin/omarfitouri

/**
 * Plat
 *
 * @ORM\Table(name="plat")
 * @ORM\Entity
 */
<<<<<<< HEAD
class Plat implements \JsonSerializable
=======
class Plat
>>>>>>> origin/omarfitouri
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPlat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
<<<<<<< HEAD
     * @Groups("post:read")
=======
>>>>>>> origin/omarfitouri
     */
    private $idplat;

    /**
<<<<<<< HEAD
     * @var string
     *
     * @ORM\Column(name="nomPlat", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="please enter the plat name")
     * @Groups("post:read")
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
     * @Groups("post:read")
=======
     * @var float
     *
     * @ORM\Column(name="prixPlat", type="float", precision=10, scale=0, nullable=false)
>>>>>>> origin/omarfitouri
     */
    private $prixplat;

    /**
     * @var string
     *
<<<<<<< HEAD
     * @ORM\Column(name="photoPlat", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="please enter plat photo")
     * @Groups("post:read")
=======
     * @ORM\Column(name="photoPlat", type="string", length=300, nullable=false)
>>>>>>> origin/omarfitouri
     */
    private $photoplat;

    /**
<<<<<<< HEAD
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=300, nullable=false)
     * @Assert\NotBlank(message="please enter description")
     * @Groups("post:read")
     */
    private $description;
=======
     * @var int
     *
     * @ORM\Column(name="numRestaurant", type="integer", nullable=false)
     */
    private $numrestaurant;
>>>>>>> origin/omarfitouri

    public function getIdplat(): ?int
    {
        return $this->idplat;
    }

<<<<<<< HEAD
    public function getNomplat(): ?string
    {
        return $this->nomplat;
    }

    public function setNomplat(string $nomplat): self
    {
        $this->nomplat = $nomplat;

        return $this;
    }

=======
>>>>>>> origin/omarfitouri
    public function getPrixplat(): ?float
    {
        return $this->prixplat;
    }

    public function setPrixplat(float $prixplat): self
    {
        $this->prixplat = $prixplat;

        return $this;
    }

<<<<<<< HEAD
    public function getPhotoplat() 
=======
    public function getPhotoplat(): ?string
>>>>>>> origin/omarfitouri
    {
        return $this->photoplat;
    }

<<<<<<< HEAD
    public function setPhotoplat($photoplat)
=======
    public function setPhotoplat(string $photoplat): self
>>>>>>> origin/omarfitouri
    {
        $this->photoplat = $photoplat;

        return $this;
    }

<<<<<<< HEAD
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
=======
    public function getNumrestaurant(): ?int
    {
        return $this->numrestaurant;
    }

    public function setNumrestaurant(int $numrestaurant): self
    {
        $this->numrestaurant = $numrestaurant;
>>>>>>> origin/omarfitouri

        return $this;
    }

<<<<<<< HEAD
    public function __toString()
    {
        return $this->nomplat;
    }

    public function jsonSerialize()
    {
        return [
            'idplat' => $this->getIdplat(),
            'nomplat'=>$this->getNomplat(),
            'description'=>$this->getDescription()
        ];
    }
=======

>>>>>>> origin/omarfitouri
}
