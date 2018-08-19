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