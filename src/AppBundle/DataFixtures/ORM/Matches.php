<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Match;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Matches extends Fixture implements OrderedFixtureInterface
{
    /**
     * @var Match
     */
    private $match;

    public function load(ObjectManager $manager)
    {
        $teams = $manager->getRepository('AppBundle:Team')->findAll();
        foreach ($teams as $index => $team) {
            if ($index%2 == 0) {
                $this->match = new Match();
                $this->match->setTeam1($team);
            } else {
                $this->match->setTeam2($team)
                ->setDate(new \DateTime());
                $manager->persist($this->match);
            }
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 4;
    }
}
