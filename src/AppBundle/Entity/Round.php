<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Round
 *
 * @ORM\Table(name="round")
 * @ORM\Entity()
 */
class Round
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
     * @ORM\ManyToOne(targetEntity="Pot", inversedBy="rounds")
     * @ORM\JoinColumn(name="pot_id", referencedColumnName="id")
     */
    private $pot;

    /**
     * @ORM\OneToMany(targetEntity="Bet", mappedBy="round")
     */
    private $bets;

    /**
     * @ORM\OneToMany(targetEntity="RoundMatchType", mappedBy="round")
     */
    private $roundMatchTypes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bets = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Round
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
     * Set pot
     *
     * @param \AppBundle\Entity\Pot $pot
     *
     * @return Round
     */
    public function setPot(\AppBundle\Entity\Pot $pot = null)
    {
        $this->pot = $pot;

        return $this;
    }

    /**
     * Get pot
     *
     * @return \AppBundle\Entity\Pot
     */
    public function getPot()
    {
        return $this->pot;
    }

    /**
     * Add bet
     *
     * @param \AppBundle\Entity\Bet $bet
     *
     * @return Round
     */
    public function addBet(\AppBundle\Entity\Bet $bet)
    {
        $this->bets[] = $bet;

        return $this;
    }

    /**
     * Remove bet
     *
     * @param \AppBundle\Entity\Bet $bet
     */
    public function removeBet(\AppBundle\Entity\Bet $bet)
    {
        $this->bets->removeElement($bet);
    }

    /**
     * Get bets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBets()
    {
        return $this->bets;
    }

    /**
     * Add roundMatchType
     *
     * @param \AppBundle\Entity\RoundMatchType $roundMatchType
     *
     * @return Round
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
