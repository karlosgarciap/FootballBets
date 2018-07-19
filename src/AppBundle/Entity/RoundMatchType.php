<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * RoundMatchType
 *
 * @ORM\Table(name="round_match_type")
 * @ORM\Entity()
 */
class RoundMatchType
{
    const TYPE_RESULT = 0;
    const TYPE_SIGN = 1;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Round", inversedBy="roundMatchTypes")
     * @ORM\JoinColumn(name="round_id", referencedColumnName="id")
     */
    private $round;

    /**
     * @ORM\ManyToOne(targetEntity="Match", inversedBy="roundMatchTypes")
     * @ORM\JoinColumn(name="match_id", referencedColumnName="id")
     */
    private $match;

    /**
     * @ORM\OneToMany(targetEntity="MatchResult", mappedBy="roundMatchType")
     */
    private $matchResults;

    /**
     * @ORM\OneToMany(targetEntity="Round", mappedBy="pot")
     */
    private $rounds;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @var \DateTime $contentChanged
     *
     * @ORM\Column(name="content_changed", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="change", field={"round", "match"})
     */
    private $contentChanged;

    /**
     * @var int
     */
    private $type = self::TYPE_RESULT;

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
     * Set round
     *
     * @param \AppBundle\Entity\Round $round
     *
     * @return RoundMatchType
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
     * Set match
     *
     * @param \AppBundle\Entity\Match $match
     *
     * @return RoundMatchType
     */
    public function setMatch(\AppBundle\Entity\Match $match = null)
    {
        $this->match = $match;

        return $this;
    }

    /**
     * Get match
     *
     * @return \AppBundle\Entity\Match
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * Add matchResult
     *
     * @param \AppBundle\Entity\MatchResult $matchResult
     *
     * @return RoundMatchType
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
