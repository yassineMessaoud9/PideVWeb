<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="App\Repository\EvenementRepository")
 *
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
     * @Assert\NotBlank(message=" titre doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un titre au mini de 5 caractere"
     *     )
     * @ORM\Column(name="intituleEve", type="string", length=50, nullable=false)
     */
    private $intituleeve;

    /**
     * @var string
     * @Assert\NotBlank(message=" Pays doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un titre au mini de 5 caractere"
     *     )
     * @ORM\Column(name="paysEve", type="string", length=50, nullable=false)
     */
    private $payseve;

    /**
     * @var float
     * @Assert\NotBlank(message=" no free events mate")
     * @Assert\Type(type="float", message="List price must be a numeric value")
     * @Assert\GreaterThanOrEqual(message="list price must be no less than zero", value = 0)
     * @ORM\Column(name="prixEve", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixeve;

    /**
     * @var \DateTime
     * @Assert\DateTime(format="Y/m/d")
     * @Assert\LessThanOrEqual(
     *     value="0 days",
     *     message="should be today's date or less"
     * )
     * @ORM\Column(name="datedebutEve", type="date", nullable=false)
     */
    private $datedebuteve;

    /**
     * @var \DateTime
     * @ORM\Column(name="datefinEve", type="date", nullable=false)
     * @Assert\DateTime(format="Y/m/d")
     * @Assert\GreaterThan(
     *     value="0 days",
     *     message="today's date or more"
     * )
     */
    private $datefineve;

    /**
     * @var string
     *
     * @Assert\NotBlank(message=" adresse doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer une adrresse e au mini de 25 caractere"
     *     )
     * @ORM\Column(name="addressEve", type="string", length=50, nullable=false)
     */
    private $addresseve;

    /**
     * @var string
     * @Assert\NotBlank(message=" Type doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un type au mini de 5 caractere"
     *     )
     * @ORM\Column(name="typeEve", type="string", length=50, nullable=false)
     */
    private $typeeve;

    /**
     * @var string
     * @ORM\Column(name="photoEve", type="string", length=50, nullable=false)
     */
    private $photoeve;

    /**
     * @var int
     * @Assert\NotBlank(message=" ajoutez des places")
     * @Assert\Type(type="Integer", message="List price must be a numeric value")
     * @Assert\GreaterThanOrEqual(message="nombre de place must be no less than zero", value = 0)
     * @ORM\Column(name="nbplaceEve", type="integer", nullable=false)
     */
    private $nbplaceeve;

    /**
     * @var string
     * @Assert\NotBlank(message="description  doit etre non vide")
     * @Assert\Length(
     *      min = 7,
     *      max = 100,
     *      minMessage = "doit etre >=7 ",
     *      maxMessage = "doit etre <=300" )
     * @ORM\Column(name="descriptionEve", type="string", length=300, nullable=false)
     */
    private $descriptioneve;

    public function getIdeve(): ?int
    {
        return $this->ideve;
    }

    public function getIntituleeve(): ?string
    {
        return $this->intituleeve;
    }

    public function setIntituleeve(string $intituleeve): self
    {
        $this->intituleeve = $intituleeve;

        return $this;
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

    public function getPrixeve(): ?float
    {
        return $this->prixeve;
    }

    public function setPrixeve(float $prixeve): self
    {
        $this->prixeve = $prixeve;

        return $this;
    }

    public function getDatedebuteve(): ?\DateTimeInterface
    {
        return $this->datedebuteve;
    }

    public function setDatedebuteve(\DateTimeInterface $datedebuteve): self
    {
        $this->datedebuteve = $datedebuteve;

        return $this;
    }

    public function getDatefineve(): ?\DateTimeInterface
    {
        return $this->datefineve;
    }

    public function setDatefineve(\DateTimeInterface $datefineve): self
    {
        $this->datefineve = $datefineve;

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

    public function getPhotoeve()
    {
        return $this->photoeve;
    }

    public function setPhotoeve($photoeve)
    {
        $this->photoeve = $photoeve;

        return $this;
    }

    public function getNbplaceeve(): ?int
    {
        return $this->nbplaceeve;
    }

    public function setNbplaceeve(int $nbplaceeve): self
    {
        $this->nbplaceeve = $nbplaceeve;

        return $this;
    }

    public function getDescriptioneve(): ?string
    {
        return $this->descriptioneve;
    }

    public function setDescriptioneve(string $descriptioneve): self
    {
        $this->descriptioneve = $descriptioneve;

        return $this;
    }

    public function __toString()
    {
    return $this->intituleeve;
    }


}
