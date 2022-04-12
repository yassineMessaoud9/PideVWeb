<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commandplat
 *
 * @ORM\Table(name="commandplat", indexes={@ORM\Index(name="fk_compla", columns={"idCommande"}), @ORM\Index(name="fk_Plat", columns={"Plat"})})
 * @ORM\Entity
 */
class Commandplat
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
     * @var \Plat
     *
     * @ORM\ManyToOne(targetEntity="Plat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Plat", referencedColumnName="idPlat")
     * })
     */
    private $plat;

    /**
     * @var \Commandrestau
     *
     * @ORM\ManyToOne(targetEntity="Commandrestau")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCommande", referencedColumnName="Num_Commande")
     * })
     */
    private $idcommande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlat(): ?Plat
    {
        return $this->plat;
    }

    public function setPlat(?Plat $plat): self
    {
        $this->plat = $plat;

        return $this;
    }

    public function getIdcommande(): ?Commandrestau
    {
        return $this->idcommande;
    }

    public function setIdcommande(?Commandrestau $idcommande): self
    {
        $this->idcommande = $idcommande;

        return $this;
    }


}
