<?php

namespace CR32\QuestionnaireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="CR32\QuestionnaireBundle\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\Length(min=2, minMessage="votre nom doit contenir au moins 2 caractéres")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     * @Assert\Length(min=2, minMessage="votre prénom doit contenir au moins 2 caractéres")
     */
    private $surname;

    /**
    * @var string
    * @ORM\Column(name="secret", type="string", length=255)
    * @Assert\Length(min=2, minMessage="Votre mot secret doit contenir au moins 2 caractéres")
    */
    private $secret;

    /**
    * @var string
    * @ORM\Column(name="club", type="string", length=255)
    * @Assert\Length(min=2, minMessage="Votre nom de club doit contenir au moins 2 caractéres")
    */
    private $club;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\Email(checkMX=true)
     */
    private $email;

    /**
     * @var bool
     *
     * @ORM\Column(name="subscription", type="boolean")
     */
    private $subscription;




    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Contact
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname.
     *
     * @param string $surname
     *
     * @return Contact
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname.
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set subscription.
     *
     * @param bool $subscription
     *
     * @return Contact
     */
    public function setSubscription($subscription)
    {
        $this->subscription = $subscription;

        return $this;
    }

    /**
     * Get subscription.
     *
     * @return bool
     */
    public function getSubscription()
    {
        return $this->subscription;
    }

    /**
     * Set secret.
     *
     * @param string $secret
     *
     * @return Contact
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;

        return $this;
    }

    /**
     * Get secret.
     *
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * Set club.
     *
     * @param string $club
     *
     * @return Contact
     */
    public function setClub($club)
    {
        $this->club = $club;

        return $this;
    }

    /**
     * Get club.
     *
     * @return string
     */
    public function getClub()
    {
        return $this->club;
    }
}
