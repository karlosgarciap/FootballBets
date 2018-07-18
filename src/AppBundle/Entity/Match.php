<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Match
 *
 * @ORM\Table(name="matches")
 * @ORM\Entity()
 */
class Match
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
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="team1_id", referencedColumnName="id")
     */
    private $team1;

    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="team2_id", referencedColumnName="id")
     */
    private $team2;
    
    /**
     * @var datetime
     *
     * @Assert\DateTime()
     * @Assert\NotBlank()
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    
    /**
     * @var integer
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     * @ORM\Column(name="goals1", type="integer")
     */
    private $goals1 = 0;

    /**
     * @var integer
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     * @ORM\Column(name="goals2", type="integer")
     */
    private $goals2 = 0;

    /**
     * @ORM\OneToMany(targetEntity="RoundMatchType", mappedBy="match")
     */
    private $roundMatchTypes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roundMatchTypes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Match
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set goals1
     *
     * @param integer $goals1
     *
     * @return Match
     */
    public function setGoals1($goals1)
    {
        $this->goals1 = $goals1;

        return $this;
    }

    /**
     * Get goals1
     *
     * @return integer
     */
    public function getGoals1()
    {
        return $this->goals1;
    }

    /**
     * Set goals2
     *
     * @param integer $goals2
     *
     * @return Match
     */
    public function setGoals2($goals2)
    {
        $this->goals2 = $goals2;

        return $this;
    }

    /**
     * Get goals2
     *
     * @return integer
     */
    public function getGoals2()
    {
        return $this->goals2;
    }

    /**
     * Set team1
     *
     * @param \AppBundle\Entity\Team $team1
     *
     * @return Match
     */
    public function setTeam1(\AppBundle\Entity\Team $team1 = null)
    {
        $this->team1 = $team1;

        return $this;
    }

    /**
     * Get team1
     *
     * @return \AppBundle\Entity\Team
     */
    public function getTeam1()
    {
        return $this->team1;
    }

    /**
     * Set team2
     *
     * @param \AppBundle\Entity\Team $team2
     *
     * @return Match
     */
    public function setTeam2(\AppBundle\Entity\Team $team2 = null)
    {
        $this->team2 = $team2;

        return $this;
    }

    /**
     * Get team2
     *
     * @return \AppBundle\Entity\Team
     */
    public function getTeam2()
    {
        return $this->team2;
    }

    /**
     * Add roundMatchType
     *
     * @param \AppBundle\Entity\RoundMatchType $roundMatchType
     *
     * @return Match
     */
    public function addRoundMatchType(\AppBundle\Entity\RoundMatchType $roundMatchType)
    {
        $this->roundMatchTypes[] = $roundMatchType;

        return $this;
    }

    /**
     * Remove roundMatchType
     *
     * @param \AppBundle\Entity\RoundMatchType $roundMatchType
     */
    public function removeRoundMatchType(\AppBundle\Entity\RoundMatchType $roundMatchType)
    {
        $this->roundMatchTypes->removeElement($roundMatchType);
    }

    /**
     * Get roundMatchTypes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoundMatchTypes()
    {
        return $this->roundMatchTypes;
    }
}
