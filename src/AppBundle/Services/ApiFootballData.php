<?php

namespace AppBundle\Services;

/**
 * Class ApiFootballData
 * @package AppBundle\Services
 */
class ApiFootballData
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $apiToken;

    /**
     * @var array
     */
    private $arrayCompetitions = [
        2002 => 'bundesliga_germany',
        2014 => 'primera_division',
        2015 => 'ligue_1_france',
        2017 => 'primera_liga_portugal',
        2021 => 'premier_league'
    ];

    /**
     * ApiFootballData constructor.
     * @param $url
     * @param $apiToken
     */
    public function __construct($url, $apiToken)
    {
        $this->url = $url;
        $this->apiToken = $apiToken;
    }

    /**
     * @return mixed
     */
    public function getCompetitions()
    {
        return $this->request('competitions/');
    }

    /**
     * @param $competitionId
     * @return mixed
     */
    public function getCompetitionTeams($competitionId)
    {
        return $this->request('competitions/' . $competitionId . '/teams');
    }

    /**
     * @param $competitionId
     * @return mixed
     */
    public function getCompetitionMatches($competitionId)
    {
        return $this->request('competitions/' . $competitionId . '/matches');
    }


    /**
     * @param $competitionId
     * @return mixed
     */
    public function getCompetitionStandings($competitionId)
    {
        return $this->request('competitions/' . $competitionId . '/standings');
    }

    /**
     * @return array
     */
    public function getArrayCompetitions()
    {
        return $this->arrayCompetitions;
    }

    /**
     * @param $resource
     * @return mixed
     */
    private function request($resource)
    {
        $array = array();
        $array['http']['method'] = 'GET';
        $array['http']['header'] = 'X-Auth-Token: ' . $this->apiToken;
        $response = file_get_contents(  $this->url . $resource,
                                        false,
                                        stream_context_create($array));
        return json_decode($response);
    }
}