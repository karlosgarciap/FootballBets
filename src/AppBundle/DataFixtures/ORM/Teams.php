<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class Teams
 * @package AppBundle\DataFixtures\ORM
 */
class Teams extends Fixture implements ContainerAwareInterface, OrderedFixtureInterface
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
                            '/../src/AppBundle/DataFixtures/ORM/files/teams';

        $resource = opendir($pathToFixturesFiles);

        while (false !== ($file = readdir($resource))) {
            if (!in_array($file, ['.', '..'])) {
                $json = json_decode(file_get_contents($pathToFixturesFiles . '/' . $file));
                foreach ($json->teams as $teamData) {
                    $team = new Team();
                    $team->setName($teamData->name);
                    $manager->persist($team);
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
        return 2;
    }
}
