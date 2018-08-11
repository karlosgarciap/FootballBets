<?php

namespace AppBundle\Providers\FootballDataOrg;

use AppBundle\Entity\Country;
use AppBundle\Entity\Team;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class Importer
 * @package AppBundle\Providers\FootballDataOrg
 */
class Importer
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * Importer constructor.
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param object $jsonData
     */
    public function importCountries(object $jsonData)
    {
        foreach ($jsonData->competitions as $jsonCompetitionData) {
            $country = $this->objectManager->getRepository('AppBundle:Country')->findOneBy(['footballDataOrgId' => $jsonCompetitionData->area->id]);

            if (!($country instanceof Country) && !in_array($jsonCompetitionData->area->name, ['Europe', 'Oceania', 'World'])) {
                $country = new Country();
                $country->setName($jsonCompetitionData->area->name)
                    ->setFootballDataOrgId($jsonCompetitionData->area->id);
                $this->objectManager->persist($country);
                $this->objectManager->flush();
            }
        }
    }

    /**
     * @param object $jsonData
     */
    public function importTeams(object $jsonData)
    {
        foreach ($jsonData->teams as $jsonTeamData) {
            $team = $this->objectManager->getRepository('AppBundle:Team')->findOneBy(['footballDataOrgId' => $jsonTeamData->id]);

            if (!$team instanceof Team) {
                $country = $this->objectManager->getRepository('AppBundle:Country')->findOneBy(['footballDataOrgId' => $jsonTeamData->area->id]);
                $team = new Team();
                $team->setName($jsonTeamData->name)->setCountry($country)->setFootballDataOrgId($jsonTeamData->id);
                $this->objectManager->persist($team);
                $this->objectManager->flush();
            }
        }
    }
}
