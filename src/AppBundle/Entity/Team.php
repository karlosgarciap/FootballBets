<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Team
 *
 * @ORM\Table(name="teams")
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
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min = 4, max=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="shield", type="string", length=255, nullable=true)
     */
    private $shield;

    /**
     * @ORM\ManyToOne(targetEntity="Country")
     */
    private $country;

    /**
     * @var integer
     *
     * @ORM\Column(name="football_data_org_id", type="integer", unique=true)
     */
    private $footballDataOrgId;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

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

    /**
     * Set country
     *
     * @param Country $country
     *
     * @return Team
     */
    public function setCountry(Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set footballDataOrgId.
     *
     * @param int $footballDataOrgId
     *
     * @return Team
     */
    public function setFootballDataOrgId($footballDataOrgId)
    {
        $this->footballDataOrgId = $footballDataOrgId;

        return $this;
    }

    /**
     * Get footballDataOrgId.
     *
     * @return int
     */
    public function getFootballDataOrgId()
    {
        return $this->footballDataOrgId;
    }

    /**
     * Set created.
     *
     * @param \DateTime $created
     *
     * @return Team
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created.
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }
}
