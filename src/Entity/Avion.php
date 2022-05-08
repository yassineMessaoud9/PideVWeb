<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Avion
 *
 * @ORM\Table(name="avion")
 * @ORM\Entity (repositoryClass="App\Repository\AvionRepository")
 */

class Avion
{
    /**
     * @var int
     *
     * @ORM\Column(name="numserieavion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numserieavion;

    /**
     * @var string
     *@Assert\NotBlank(message="marque  doit etre non vide")
     *@Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un nom au mini de 5 caracteres"
     *
     *     )
     * @ORM\Column(name="marque", type="string", length=30, nullable=false)
     * 
     */
    private $marque;

    /**
     * @var int
     *@Assert\Range(min=50, max=300)
     *
     * @ORM\Column(name="nbrplace", type="integer", nullable=false)
     */
    private $nbrplace;

    public function getNumserieavion(): ?int
    {
        return $this->numserieavion;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getNbrplace(): ?int
    {
        return $this->nbrplace;
    }

    public function setNbrplace(int $nbrplace): self
    {
        $this->nbrplace = $nbrplace;

        return $this;
    }
    public function __toString()
    {
        return $this->marque.' '.$this->numserieavion;

    }



}
