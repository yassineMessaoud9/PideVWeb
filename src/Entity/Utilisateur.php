<?php

namespace App\Entity;

<<<<<<< HEAD
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Serializer\Annotation\Groups;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints as CaptchaAssert;
use Symfony\Component\Form\Extension\Core\Type\FileType;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class Utilisateur implements UserInterface, \Serializable, \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="idU",type="integer")
     * @Groups("act")
     * @Groups("post:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email(
     * message = "{{ value }} is not a valid email.")
     * @Groups("act")
     * @Groups("post:read")
     */
    private $email;

    /**
     * @ORM\Column(name="role",type="json")
     * @Groups("act")
     * @Groups("post:read")
     */
    private $roles;

    /**
     * @var string The hashed password
     * @ORM\Column(name="motpasse",type="string")
     * @Groups("act")
     * @Groups("post:read")
     *
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="please enter your name")
     * @Groups("act")
     * @Groups("post:read")
=======
use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur", uniqueConstraints={@ORM\UniqueConstraint(name="email", columns={"email"}), @ORM\UniqueConstraint(name="email_2", columns={"email"})})
 * @ORM\Entity
 */
class Utilisateur
{
    /**
     * @var int
     *
     * @ORM\Column(name="idU", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idu;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
>>>>>>> origin/omarfitouri
     */
    private $nom;

    /**
<<<<<<< HEAD
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="please enter your prenom")
     * @Groups("act")
     * @Groups("post:read")
=======
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=false)
>>>>>>> origin/omarfitouri
     */
    private $prenom;

    /**
<<<<<<< HEAD
     * @ORM\Column(type="string", length=255)
     * @Groups("act")
     * @Groups("post:read")
     *
=======
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=100, nullable=false)
>>>>>>> origin/omarfitouri
     */
    private $adresse;

    /**
<<<<<<< HEAD
     * @ORM\Column(type="string", length=255)
     * @Groups("act")
     * @Groups("post:read")
     *
=======
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="motpasse", type="string", length=250, nullable=false)
     */
    private $motpasse;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=300, nullable=false)
>>>>>>> origin/omarfitouri
     */
    private $photo;

    /**
<<<<<<< HEAD
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="please enter pays")
     * @Groups("act")
     * @Groups("post:read")
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("act")
     * @Groups("post:read")
     */
    private $activated = 'Active';

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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return $this->roles;
    }
    public function __construct($rol)
    {
        $this->roles = [$rol];
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
=======
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=30, nullable=false)
     */
    private $role;

    public function getIdu(): ?int
    {
        return $this->idu;
>>>>>>> origin/omarfitouri
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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

<<<<<<< HEAD
    public function getPhoto()
=======
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMotpasse(): ?string
    {
        return $this->motpasse;
    }

    public function setMotpasse(string $motpasse): self
    {
        $this->motpasse = $motpasse;

        return $this;
    }

    public function getPhoto(): ?string
>>>>>>> origin/omarfitouri
    {
        return $this->photo;
    }

<<<<<<< HEAD
    public function setPhoto($photo)
=======
    public function setPhoto(string $photo): self
>>>>>>> origin/omarfitouri
    {
        $this->photo = $photo;

        return $this;
    }

<<<<<<< HEAD
    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getActivated(): ?string
    {
        return $this->activated;
    }

    public function setActivated(string $activated): self
    {
        $this->activated = $activated;

        return $this;
    }

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->nom,
            $this->email,
            $this->password,
            $this->pays,
            $this->activated,
        ]);
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'nom' => $this->getNom(),
            'prenom' => $this->getPrenom(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'pays' => $this->getPays(), 
            'activated' => $this->getActivated(),
            'photo' => $this->getPhoto(),
            'role' => $this->getRoles(),
            'adresse' => $this->getAdresse(),
        ];
    }

    public function unserialize($data)
    {
        list(
            $this->id,
            $this->nom,
            $this->email,
            $this->password,
            $this->tel,
            $this->stateuser,
        ) = unserialize($data, ['allowed_classes' => false]);
    }
    public function __toString()
    {
        return $this->nom;
    }
=======
    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }
    public function __toString() {
        return $this->nom;
    }


>>>>>>> origin/omarfitouri
}
