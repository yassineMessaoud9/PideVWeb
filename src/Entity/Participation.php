<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation", indexes={@ORM\Index(name="fk_idu", columns={"idU"}), @ORM\Index(name="fk_idEve", columns={"idEve"})})
 * @ORM\Entity
 */
class Participation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idParticipation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idparticipation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateParticipation", type="date", nullable=false)
     */
    private $dateparticipation;

    /**
     * @var string
     *
     * @ORM\Column(name="lieuParticipation", type="string", length=50, nullable=false)
     */
    private $lieuparticipation;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrParticipant", type="integer", nullable=false)
     */
    private $nbrparticipant;

    /**
     * @var \Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEve", referencedColumnName="idEve")
     * })
     */
    private $ideve;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idU", referencedColumnName="idU")
     * })
     */
    private $idu;

    public function getIdparticipation(): ?int
    {
        return $this->idparticipation;
    }

    public function getDateparticipation(): ?\DateTimeInterface
    {
        return $this->dateparticipation;
    }

    public function setDateparticipation(\DateTimeInterface $dateparticipation): self
    {
        $this->dateparticipation = $dateparticipation;

        return $this;
    }

    public function getLieuparticipation(): ?string
    {
        return $this->lieuparticipation;
    }

    public function setLieuparticipation(string $lieuparticipation): self
    {
        $this->lieuparticipation = $lieuparticipation;

        return $this;
    }

    public function getNbrparticipant(): ?int
    {
        return $this->nbrparticipant;
    }

    public function setNbrparticipant(int $nbrparticipant): self
    {
        $this->nbrparticipant = $nbrparticipant;

        return $this;
    }

    public function getIdeve(): ?Evenement
    {
        return $this->ideve;
    }

    public function setIdeve(?Evenement $ideve): self
    {
        $this->ideve = $ideve;

        return $this;
    }

    public function getIdu(): ?Utilisateur
    {
        return $this->idu;
    }

    public function setIdu(?Utilisateur $idu): self
    {
        $this->idu = $idu;

        return $this;
    }


}
