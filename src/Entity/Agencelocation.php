<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * Agencelocation
 *
 * @ORM\Table(name="agencelocation")
 * @ORM\Entity  (repositoryClass="App\Repository\AgenceLocationRepository")
 */
class Agencelocation implements UserInterface, \Serializable 
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
      *  @Assert\NotBlank(message=" nom doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un nom d'agence au mini de 5 caracteres"
     *
     *     )
     *
     * @ORM\Column(name="nomAgence", type="string", length=50, nullable=false)
     */
    private $nomagence;

    /**
     * @var int
     *  @Assert\NotBlank(message="Contact  doit etre non vide")
     * @Assert\Range(min=10000000, max=99999999,minMessage="sup a 8 chiffre")
     * @ORM\Column(name="contactAgence", type="integer", nullable=false)
     */
    private $contactagence;

    /**
     * @var string
     * @Assert\NotBlank(message=" nom doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un nom d'agence au mini de 5 caracteres"
     *
     *     )
     * @ORM\Column(name="addressAgence", type="string", length=50, nullable=false)
     */
    private $addressagence;

    /**
     * @var string
     *
     * @ORM\Column(name="logoAgence", type="string", length=50, nullable=false)
     */
    private $logoagence;

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
    public function __toString()
    {
        return $this->getNomagence();

    }
    public function serialize()
    {
        return serialize([
          
            $this->idagence,
            $this->nomagence,
            $this->contactagence,
            $this->addressagence,
            $this->logoagence,
        ]);
    }

    public function unserialize($data)
    {
        list(
            
            $this->idagence,
            $this->nomagence,
            $this->contactagence,
            $this->addressagence,
            $this->logoagence,
        ) = unserialize($data, ['allowed_classes' => false]);
    }

    public function getSalt()
    {

    }

    public function getUsername()
    {
        return null;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @see UserInterface
     */
    public function getRoles()
    {
        return null;
    }
/**
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return null;
    }

}
