<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Providers\FootballDataOrg\Importer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class Countries
 * @package AppBundle\DataFixtures\ORM
 */
class Countries extends Fixture implements OrderedFixtureInterface
{
    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * @var Importer
     */
    private $footballDataOrgImporter;

    /**
     * Countries constructor.
     * @param KernelInterface $kernel
     * @param Importer $footballDataOrgImporter
     */
    public function __construct(KernelInterface $kernel, Importer $footballDataOrgImporter)
    {
        $this->kernel = $kernel;
        $this->footballDataOrgImporter = $footballDataOrgImporter;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $pathToFixturesFiles =  $this->kernel->getRootDir() . '/../src/AppBundle/DataFixtures/ORM/files';
        $json = json_decode(file_get_contents($pathToFixturesFiles . '/competitions.yml'));
        $this->footballDataOrgImporter->importCountries($json);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }
}
