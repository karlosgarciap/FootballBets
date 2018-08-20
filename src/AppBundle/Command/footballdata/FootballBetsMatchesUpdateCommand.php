<?php

namespace AppBundle\Command\footballdata;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FootballBetsMatchesUpdateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('football-bets:footballdata-matches-update')
            ->setDescription('Update YML files from Football Data API')
            ->addArgument('competitionId', InputArgument::REQUIRED, 'Competition Id')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $competitionId = $input->getArgument('competitionId');
        $apiFootballData = $this->getContainer()->get('AppBundle\Services\ApiFootballData');
        $jsonObject = $apiFootballData->getCompetitionMatches($competitionId);
        $this->checkFolder();
        file_put_contents(
            $this->getDestinationfolder() .
                    $apiFootballData->getArrayCompetitions()[$competitionId] . '.yml',
                    json_encode($jsonObject)
                );

        $output->writeln('Update success.');
    }

    private function checkFolder()
    {
        if(!is_dir($this->getDestinationfolder())){
            dump($this->getDestinationfolder());
            mkdir($this->getDestinationfolder());
        }
    }

    private function getDestinationfolder()
    {
        return __DIR__ . '/../../../../' . $this->getContainer()->getParameter('football_data_yml_files_folder');
    }
}
