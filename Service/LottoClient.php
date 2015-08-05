<?php

namespace Dwr\LottoClientBundle\Service;

use DateTime;
use Dwr\LottoClientBundle\Exception\LottoClientException;
use Exception;
use SoapClient;

class LottoClient
{
    /**
     *  Types of bets
     */
    const DUZY_LOTEK  = 'wynikiLotto';
    const MINI_LOTEK  = 'wynikiLotto';
    const MULTI_LOTEK = 'wynikiMulti';
    const JOKER       = 'wynikiJoker';
    const KASKADA     = 'wynikiKaskada';

    /**
     * @var SoapClient
     */
    private $client;

    /**
     * @param  SoapClient $client
     */
    public function __construct(SoapClient $client)
    {
        $this->client = $client;
    }

    /**
     * Gets recently results.
     * You can take from 1 to 10 recently results by specific type of bet.
     *
     * @param string $betType         Bet type from constants.
     * @param int    $numberOfResults From 1 to 10.
     *
     * @return array
     */
    public function getRecentlyResults($betType, $numberOfResults = 10)
    {
        $today = new DateTime();
        $results = $this->getResults($today, $betType);

        return array_slice($results, 0, $numberOfResults);
    }

    /**
     * Gets recently results by date.
     * You can take from 1 to 10 recently results by specific date and type of bet.
     *
     * @param DateTime $date            Date
     * @param string   $betType         Bet type from constants.
     * @param int      $numberOfResults From 1 to 10.
     *
     * @return array
     */
    public function getResultsByDate(DateTime $date, $betType, $numberOfResults = 10)
    {
        $results = $this->getResults($date, $betType);

        return array_slice($results, 0, $numberOfResults);
    }

    /**
     * Gets results from lotto server
     *
     * @param DateTime $date
     * @param $betType
     *
     * @return mixed
     *
     * @throws LottoClientException
     */
    private function getResults(DateTime $date, $betType)
    {
        try {
            $results = $this->client
                ->getSymbianWyniki($date->format('Y-m-d'))
                ->$betType;
            $betName = ucfirst(str_replace('wyniki', 'wynik', $betType));

            return $results->$betName;

        } catch (Exception $e) {
            throw new LottoClientException($e->getMessage());
        }
    }

}
