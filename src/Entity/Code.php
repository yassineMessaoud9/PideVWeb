<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Code
 *
 * @ORM\Table(name="code")
 * @ORM\Entity
 */
class Code
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCode", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcode;

    /**
     * @var string
     *
     * @ORM\Column(name="Code", type="string", length=8, nullable=false)
     */
    private $code;

    public function getIdcode(): ?int
    {
        return $this->idcode;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }


}
