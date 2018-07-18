<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pot
 *
 * @ORM\Table(name="pot")
 * @ORM\Entity()
 */
class Pot
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
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Round", mappedBy="pot")
     */
    private $rounds;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rounds = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Pot
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add round
     *
     * @param \AppBundle\Entity\Round $round
     *
     * @return Pot
     */
    public function addRound(\AppBundle\Entity\Round $round)
    {
        $this->rounds[] = $round;

        return $this;
    }

    /**
     * Remove round
     *
     * @param \AppBundle\Entity\Round $round
     */
    public function removeRound(\AppBundle\Entity\Round $round)
    {
        $this->rounds->removeElement($round);
    }

    /**
     * Get rounds
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRounds()
    {
        return $this->rounds;
    }
}
