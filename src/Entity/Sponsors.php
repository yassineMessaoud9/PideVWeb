<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sponsors
 *
 * @ORM\Table(name="sponsors")
 * @ORM\Entity
 */
class Sponsors
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
     * @ORM\Column(name="nomSponsors", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="champ required")
     */
    private $nomsponsors;

    /**
     * @var float
     *
     * @ORM\Column(name="prixDonations", type="float", precision=10, scale=0, nullable=false)
     * @Assert\NotBlank(message="champ required")
     */
    private $prixdonations;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeb", type="date", nullable=false)
     * @Assert\LessThanOrEqual(
     *     value="0 days",
     *     message="should today's date or less"
     * )
     */
    private $datedeb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date", nullable=false)
     * @Assert\GreaterThan(
     *     value="0 days",
     *     message="today's date or more"
     * )
     */
    private $datefin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomsponsors(): ?string
    {
        return $this->nomsponsors;
    }

    public function setNomsponsors(string $nomsponsors): self
    {
        $this->nomsponsors = $nomsponsors;

        return $this;
    }

    public function getPrixdonations(): ?float
    {
        return $this->prixdonations;
    }

    public function setPrixdonations(float $prixdonations): self
    {
        $this->prixdonations = $prixdonations;

        return $this;
    }

    public function getDatedeb(): ?\DateTimeInterface
    {
        return $this->datedeb;
    }

    public function setDatedeb(\DateTimeInterface $datedeb): self
    {
        $this->datedeb = $datedeb;

        return $this;
    }

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->datefin;
    }

    public function setDatefin(\DateTimeInterface $datefin): self
    {
        $this->datefin = $datefin;

        return $this;
    }


}
