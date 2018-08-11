<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Providers\FootballDataOrg\Importer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class Teams
 * @package AppBundle\DataFixtures\ORM
 */
class Teams extends Fixture implements OrderedFixtureInterface
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
     * Teams constructor.
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
        $pathToFixturesFiles =  $this->kernel->getRootDir() . '/../src/AppBundle/DataFixtures/ORM/files/teams';

        $resource = opendir($pathToFixturesFiles);

        while (false !== ($file = readdir($resource))) {
            if (!in_array($file, ['.', '..'])) {
                $json = json_decode(file_get_contents($pathToFixturesFiles . '/' . $file));
                $this->footballDataOrgImporter->importTeams($json);
            }
        }

        closedir($resource);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3;
    }
}
