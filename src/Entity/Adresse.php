<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank(message=" adresse doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un nom au mini de 4 caracteres"
     *
     *     )
     *
     * @ORM\Column(name="paysadresse", type="string", length=30, nullable=false)
     
     */
    private $paysadresse;

    /**
     * @var string
     * @Assert\NotBlank(message=" rue doit etre non vide")
     * @Assert\Length(
     *      min = 8,
     *      minMessage=" Entrer une rue au mini de 8 caracteres"
     *
     *     )
     *
     * @ORM\Column(name="rueadresse", type="string", length=30, nullable=false)
     * 
     */
    private $rueadresse;

    /**
     * @var int
     * @Assert\NotBlank(message="numero  doit etre non vide")
     * @Assert\Range(min=10000000, max=99999999)
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
    public function __toString()
    {
        return $this->getPaysadresse();

    }


}
