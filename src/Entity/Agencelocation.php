<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agencelocation
 *
 * @ORM\Table(name="agencelocation")
 * @ORM\Entity
 */
class Agencelocation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idAgence", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idagence;

    /**
     * @var string
     *
     * @ORM\Column(name="nomAgence", type="string", length=50, nullable=false)
     */
    private $nomagence;

    /**
     * @var int
     *
     * @ORM\Column(name="contactAgence", type="integer", nullable=false)
     */
    private $contactagence;

    /**
     * @var string
     *
     * @ORM\Column(name="addressAgence", type="string", length=50, nullable=false)
     */
    private $addressagence;

    /**
     * @var string
     *
     * @ORM\Column(name="logoAgence", type="string", length=50, nullable=false)
     */
    private $logoagence;

    /**
     * @var string
     *
     * @ORM\Column(name="PaysAgence", type="string", length=50, nullable=false)
     */
    private $paysagence;

    public function getIdagence(): ?int
    {
        return $this->idagence;
    }

    public function getNomagence(): ?string
    {
        return $this->nomagence;
    }

    public function setNomagence(string $nomagence): self
    {
        $this->nomagence = $nomagence;

        return $this;
    }

    public function getContactagence(): ?int
    {
        return $this->contactagence;
    }

    public function setContactagence(int $contactagence): self
    {
        $this->contactagence = $contactagence;

        return $this;
    }

    public function getAddressagence(): ?string
    {
        return $this->addressagence;
    }

    public function setAddressagence(string $addressagence): self
    {
        $this->addressagence = $addressagence;

        return $this;
    }

    public function getLogoagence(): ?string
    {
        return $this->logoagence;
    }

    public function setLogoagence(string $logoagence): self
    {
        $this->logoagence = $logoagence;

        return $this;
    }

    public function getPaysagence(): ?string
    {
        return $this->paysagence;
    }

    public function setPaysagence(string $paysagence): self
    {
        $this->paysagence = $paysagence;

        return $this;
    }


}
