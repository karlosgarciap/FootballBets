<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Match;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class Matches
 * @package AppBundle\DataFixtures\ORM
 */
class Matches extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $pathToFixturesFiles =  $this->container->get('kernel')->getRootDir() .
            '/../src/AppBundle/DataFixtures/ORM/files/matches';

        $resource = opendir($pathToFixturesFiles);

        $teams = [];

        while (false !== ($file = readdir($resource))) {
            if (!in_array($file, ['.', '..'])) {
                $json = json_decode(file_get_contents($pathToFixturesFiles . '/' . $file));
                foreach ($json->matches as $matchData) {
                    if (!isset($teams[$matchData->homeTeam->id])) {
                        $teams[$matchData->homeTeam->id] =
                            $manager->getRepository('AppBundle:Team')
                                ->findOneBy(['name' => $matchData->homeTeam->name]);
                    }

                    if (!isset($teams[$matchData->awayTeam->id])) {
                        $teams[$matchData->awayTeam->id] =
                            $manager->getRepository('AppBundle:Team')
                                ->findOneBy(['name' => $matchData->awayTeam->name]);
                    }

                    $match = new Match();
                    $match->setTeam1($teams[$matchData->homeTeam->id])
                        ->setTeam2($teams[$matchData->awayTeam->id])
                        ->setGoals1($matchData->score->fullTime->homeTeam != null ?
                            $matchData->score->fullTime->homeTeam : rand(0, 7))
                        ->setGoals2($matchData->score->fullTime->awayTeam != null ?
                            $matchData->score->fullTime->awayTeam : rand(0, 7))
                        ->setDate(\DateTime::createFromFormat(\DateTime::W3C, $matchData->utcDate))
                    ;

                    $manager->persist($match);
                }
            }
        }

        closedir($resource);
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
