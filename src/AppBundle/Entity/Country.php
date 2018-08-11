<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table(name="countries")
 * @ORM\Entity()
 */
class Country
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="football_data_org_id", type="integer", unique=true)
     */
    private $footballDataOrgId;

    /**
     * Get id
     *
     * @return int
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
     * @return Country
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
     * Set footballDataOrgId.
     *
     * @param int $footballDataOrgId
     *
     * @return Country
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
}
