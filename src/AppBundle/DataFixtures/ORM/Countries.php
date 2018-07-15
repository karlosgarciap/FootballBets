<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Country;
use AppBundle\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Countries extends Fixture implements ContainerAwareInterface, OrderedFixtureInterface
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
                            '/../src/AppBundle/DataFixtures/ORM/files';

        $json = json_decode(file_get_contents($pathToFixturesFiles . '/competitions.yml'));
        $array = [];
        foreach ($json->competitions as $competition) {
            $array[$competition->area->name] = null;
        }

        unset($array['Europe'], $array['Oceania'], $array['World']);

        foreach (array_keys($array) as $contryName) {
            $country = new Country();
            $country->setName($contryName);
            $manager->persist($country);
        }
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
