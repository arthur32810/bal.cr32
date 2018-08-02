<?php

namespace CR32\QuestionnaireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Danses
 *
 * @ORM\Table(name="danses")
 * @ORM\Entity(repositoryClass="CR32\QuestionnaireBundle\Repository\DansesRepository")
 */
class Danses
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var int
     *
     * @ORM\Column(name="niveau", type="smallint")
     */
    private $niveau;


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
     * Set titre.
     *
     * @param string $titre
     *
     * @return Danses
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre.
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set niveau.
     *
     * @param int $niveau
     *
     * @return Danses
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau.
     *
     * @return int
     */
    public function getNiveau()
    {
        return $this->niveau;
    }
}
