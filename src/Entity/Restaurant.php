<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Restaurant
 *
 * @ORM\Table(name="restaurant")
 * @ORM\Entity
 */
class Restaurant
{
    /**
     * @var int
     *
     * @ORM\Column(name="idrestau", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrestau;

    /**
     * @var string
     *  @Assert\NotBlank(message=" nom  restaurant doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un nom au mini de 5 caracteres"
     *
     *     )
     * @ORM\Column(name="nomrestau", type="string", length=30, nullable=false)
     */
    private $nomrestau;

    /**
     * @var string
     *  @Assert\NotBlank(message=" type doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un type au mini de 5 caracteres"
     *
     *     )
     * @ORM\Column(name="typerestau", type="string", length=30, nullable=false)
     */
    private $typerestau;

    /**
     * @var int
     * *  @Assert\NotBlank(message="nbr  doit etre non vide")
      * @Assert\Range(min=1, max=100)
     * @ORM\Column(name="nbrtable", type="integer", nullable=false)
     */
    private $nbrtable;

    /**
     * @var string
     *  @Assert\NotBlank(message=" nom doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un nom au mini de 9 caracteres"
     *
     *     )
     * @ORM\Column(name="localisation", type="string", length=30, nullable=false)
     */
    private $localisation;

    /**
     * @var int
     *  @Assert\NotBlank(message="nbr  doit etre non vide")
     * @Assert\Range(min=10000000, max=99999999,minMessage=" Entrer un num de tel superieur à 8 chiffre")
     * @ORM\Column(name="telephone", type="integer", nullable=false)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=300, nullable=false)
     */
    private $photo;

    public function getIdrestau(): ?int
    {
        return $this->idrestau;
    }

    public function getNomrestau(): ?string
    {
        return $this->nomrestau;
    }

    public function setNomrestau(string $nomrestau): self
    {
        $this->nomrestau = $nomrestau;

        return $this;
    }

    public function getTyperestau(): ?string
    {
        return $this->typerestau;
    }

    public function setTyperestau(string $typerestau): self
    {
        $this->typerestau = $typerestau;

        return $this;
    }

    public function getNbrtable(): ?int
    {
        return $this->nbrtable;
    }

    public function setNbrtable(int $nbrtable): self
    {
        $this->nbrtable = $nbrtable;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }
    public function __toString()
    {
        return $this->photo;

    }

}
