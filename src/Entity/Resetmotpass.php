<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Resetmotpass
 *
 * @ORM\Table(name="resetmotpass", indexes={@ORM\Index(name="fk_emailuser", columns={"idUser"}), @ORM\Index(name="fk_Code", columns={"idCode"})})
 * @ORM\Entity
 */
class Resetmotpass
{
    /**
     * @var int
     *
     * @ORM\Column(name="idReset", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreset;

    /**
     * @var \Code
     *
     * @ORM\ManyToOne(targetEntity="Code")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCode", referencedColumnName="idCode")
     * })
     */
    private $idcode;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="idU")
     * })
     */
    private $iduser;

    public function getIdreset(): ?int
    {
        return $this->idreset;
    }

    public function getIdcode(): ?Code
    {
        return $this->idcode;
    }

    public function setIdcode(?Code $idcode): self
    {
        $this->idcode = $idcode;

        return $this;
    }

    public function getIduser(): ?Utilisateur
    {
        return $this->iduser;
    }

    public function setIduser(?Utilisateur $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }


}
