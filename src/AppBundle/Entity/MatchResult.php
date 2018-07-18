<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MatchResult
 *
 * @ORM\Table(name="match_result")
 * @ORM\Entity()
 */
class MatchResult
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
     * @ORM\ManyToOne(targetEntity="RoundMatchType", inversedBy="matchResults")
     * @ORM\JoinColumn(name="round_match_type_id", referencedColumnName="id")
     */
    private $roundMatchType;

    /**
     * @var int
     *
     * @ORM\Column(name="goals1", type="integer", nullable=true)
     */
    private $goals1;

    /**
     * @var int
     *
     * @ORM\Column(name="goals2", type="integer", nullable=true)
     */
    private $goals2;

    /**
     * @var string
     *
     * @ORM\Column(name="sign", type="string", length=1, nullable=true)
     */
    private $sign;

    /**
     * @ORM\ManyToOne(targetEntity="Bet", inversedBy="matchResults")
     * @ORM\JoinColumn(name="bet_id", referencedColumnName="id")
     */
    private $bet;

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
     * Set goals1
     *
     * @param integer $goals1
     *
     * @return MatchResult
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
     * @return MatchResult
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
     * Set sign
     *
     * @param string $sign
     *
     * @return MatchResult
     */
    public function setSign($sign)
    {
        $this->sign = $sign;

        return $this;
    }

    /**
     * Get sign
     *
     * @return string
     */
    public function getSign()
    {
        return $this->sign;
    }

    /**
     * Set roundMatchType
     *
     * @param \AppBundle\Entity\RoundMatchType $roundMatchType
     *
     * @return MatchResult
     */
    public function setRoundMatchType(\AppBundle\Entity\RoundMatchType $roundMatchType = null)
    {
        $this->roundMatchType = $roundMatchType;

        return $this;
    }

    /**
     * Get roundMatchType
     *
     * @return \AppBundle\Entity\RoundMatchType
     */
    public function getRoundMatchType()
    {
        return $this->roundMatchType;
    }

    /**
     * Set bet
     *
     * @param \AppBundle\Entity\Bet $bet
     *
     * @return MatchResult
     */
    public function setBet(\AppBundle\Entity\Bet $bet = null)
    {
        $this->bet = $bet;

        return $this;
    }

    /**
     * Get bet
     *
     * @return \AppBundle\Entity\Bet
     */
    public function getBet()
    {
        return $this->bet;
    }
}
