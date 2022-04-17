<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idReclamation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreclamation;

    /**
     * @var string
     * @Assert\NotBlank(message=" type doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un titre au mini de 5 caractere"
     *     )
     * @ORM\Column(name="typeReclamation", type="string", length=100, nullable=false)
     */
    private $typereclamation;

    /**
     * @var string
     * @Assert\NotBlank(message="description  doit etre non vide")
     * @Assert\Length(
     *      min = 7,
     *      max = 100,
     *      minMessage = "doit etre >=7 ",
     *      maxMessage = "doit etre <=300" )
     * @ORM\Column(name="description", type="string", length=1000, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     * @ORM\Column(name="dateReclamation", type="date", nullable=false)
     * @Assert\DateTime(format="Y/m/d")
     * @Assert\GreaterThanOrEqual (
     *     value="0 days",
     *     message="today's date "
     * )
     */
    private $datereclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="intituleReclamation", type="string", length=50, nullable=false)
     */
    private $intitulereclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="etatReclamation", type="string", length=100, nullable=false)
     */
    private $etatreclamation;

    public function getIdreclamation(): ?int
    {
        return $this->idreclamation;
    }

    public function getTypereclamation(): ?string
    {
        return $this->typereclamation;
    }

    public function setTypereclamation(string $typereclamation): self
    {
        $this->typereclamation = $typereclamation;

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

    public function getDatereclamation(): ?\DateTimeInterface
    {
        return $this->datereclamation;
    }

    public function setDatereclamation(\DateTimeInterface $datereclamation): self
    {
        $this->datereclamation = $datereclamation;

        return $this;
    }

    public function getIntitulereclamation(): ?string
    {
        return $this->intitulereclamation;
    }

    public function setIntitulereclamation(string $intitulereclamation): self
    {
        $this->intitulereclamation = $intitulereclamation;

        return $this;
    }

    public function getEtatreclamation(): ?string
    {
        return $this->etatreclamation;
    }

    public function setEtatreclamation(string $etatreclamation): self
    {
        $this->etatreclamation = $etatreclamation;

        return $this;
    }


}
