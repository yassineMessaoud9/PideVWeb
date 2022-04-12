<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tourismeetablissement
 *
 * @ORM\Table(name="tourismeetablissement")
 * @ORM\Entity
 */
class Tourismeetablissement
{
    /**
     * @var int
     *
     * @ORM\Column(name="idtourisme", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtourisme;

    /**
     * @var string
     *
     * @ORM\Column(name="nomtourisme", type="string", length=40, nullable=false)
     */
    private $nomtourisme;

    /**
     * @var string
     *
     * @ORM\Column(name="paystourisme", type="string", length=50, nullable=false)
     */
    private $paystourisme;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=300, nullable=false)
     */
    private $logo;

    /**
     * @var int
     *
     * @ORM\Column(name="etoile", type="integer", nullable=false)
     */
    private $etoile;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer", nullable=false)
     */
    private $telephone;

    public function getIdtourisme(): ?int
    {
        return $this->idtourisme;
    }

    public function getNomtourisme(): ?string
    {
        return $this->nomtourisme;
    }

    public function setNomtourisme(string $nomtourisme): self
    {
        $this->nomtourisme = $nomtourisme;

        return $this;
    }

    public function getPaystourisme(): ?string
    {
        return $this->paystourisme;
    }

    public function setPaystourisme(string $paystourisme): self
    {
        $this->paystourisme = $paystourisme;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getEtoile(): ?int
    {
        return $this->etoile;
    }

    public function setEtoile(int $etoile): self
    {
        $this->etoile = $etoile;

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


}
