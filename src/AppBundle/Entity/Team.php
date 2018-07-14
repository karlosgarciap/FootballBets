<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Team
 *
 * @ORM\Table(name="teams")
 * @ORM\Entity
 * @ORM\Entity()
 */
class Team
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min = 4, max=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="escudo", type="string", length=255, nullable=true)
     */
    private $shield;

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
     * @return Team
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
     * Set shield
     *
     * @param string $shield
     *
     * @return Team
     */
    public function setShield($shield)
    {
        $this->shield = $shield;

        return $this;
    }

    /**
     * Get shield
     *
     * @return string
     */
    public function getShield()
    {
        return $this->shield;
    }
}
