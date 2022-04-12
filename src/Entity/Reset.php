<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reset
 *
 * @ORM\Table(name="reset")
 * @ORM\Entity
 */
class Reset
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="code", type="integer", nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="timeMils", type="string", length=100, nullable=false)
     */
    private $timemils;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getTimemils(): ?string
    {
        return $this->timemils;
    }

    public function setTimemils(string $timemils): self
    {
        $this->timemils = $timemils;

        return $this;
    }


}
