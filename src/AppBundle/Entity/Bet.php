<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bet
 *
 * @ORM\Table(name="bet")
 * @ORM\Entity()
 */
class Bet
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="bets")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var int
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @ORM\ManyToOne(targetEntity="Round", inversedBy="bets")
     * @ORM\JoinColumn(name="round_id", referencedColumnName="id")
     */
    private $round;

    /**
     * @ORM\OneToMany(targetEntity="MatchResult", mappedBy="bet")
     */
    private $matchResults;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->matchResults = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set amount
     *
     * @param float $amount
     *
     * @return Bet
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Bet
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set round
     *
     * @param \AppBundle\Entity\Round $round
     *
     * @return Bet
     */
    public function setRound(\AppBundle\Entity\Round $round = null)
    {
        $this->round = $round;

        return $this;
    }

    /**
     * Get round
     *
     * @return \AppBundle\Entity\Round
     */
    public function getRound()
    {
        return $this->round;
    }

    /**
     * Add matchResult
     *
     * @param \AppBundle\Entity\MatchResult $matchResult
     *
     * @return Bet
     */
    public function addMatchResult(\AppBundle\Entity\MatchResult $matchResult)
    {
        $this->matchResults[] = $matchResult;

        return $this;
    }

    /**
     * Remove matchResult
     *
     * @param \AppBundle\Entity\MatchResult $matchResult
     */
    public function removeMatchResult(\AppBundle\Entity\MatchResult $matchResult)
    {
        $this->matchResults->removeElement($matchResult);
    }

    /**
     * Get matchResults
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMatchResults()
    {
        return $this->matchResults;
    }
}
