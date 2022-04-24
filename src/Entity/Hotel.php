<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;


/**
 * Hotel
 *
 * @ORM\Table(name="hotel")
 * @ORM\Entity
 */
class Hotel
{
    /**
     * @var int
     *
     * @ORM\Column(name="idhotel", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idhotel;

    /**
     * @var string
     *  @Assert\NotBlank(message=" nom doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un nom au mini de 5 caracteres"
     *
     *     )
     *
     * @ORM\Column(name="nomhotel", type="string", length=30, nullable=false)
     */
    private $nomhotel;

    /**
     * @var string
     * @Assert\NotBlank(message=" adresse doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un nom au mini de 5 caracteres"
     *
     *     )
     *
     * @ORM\Column(name="adresse", type="string", length=30, nullable=false)
     */
    private $adresse;

    /**
     * @var int
      * @Assert\NotBlank(message="etoile  doit etre non vide")
     * @Assert\Range(min=1, max=5, minMessage=" Entrer  nbr d'etoile sup a 0 ")
     * @ORM\Column(name="etoile", type="integer", nullable=false)
     */
    private $etoile;

    /**
     * @var int
     *  @Assert\NotBlank(message="nbr  doit etre non vide")
     * @Assert\Range(min=1, max=5, minMessage=" Entrer un NBR  de chambre sup a 0 ")

     * @ORM\Column(name="nbrChambre", type="integer", nullable=false)
     */
    private $nbrchambre;

    /**
     * @var string
     * @Assert\File(mimeTypes={ "image/png", "image/jpeg" })

     * @ORM\Column(name="photo", type="string", length=300, nullable=false)
     */
    private $photo;

    public function getIdhotel(): ?int
    {
        return $this->idhotel;
    }

    public function getNomhotel(): ?string
    {
        return $this->nomhotel;
    }

    public function setNomhotel(string $nomhotel): self
    {
        $this->nomhotel = $nomhotel;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

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

    public function getNbrchambre(): ?int
    {
        return $this->nbrchambre;
    }

    public function setNbrchambre(int $nbrchambre): self
    {
        $this->nbrchambre = $nbrchambre;

        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto( $photo)
    {
        $this->photo = $photo;

        return $this;
    }
    public function __toString()
    {
        return $this->nomhotel;

    }

}
