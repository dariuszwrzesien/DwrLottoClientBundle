<?php

namespace Dwr\LottoClientBundle\Factory;

use Dwr\LottoClientBundle\Service\LottoClient;
use SoapClient;

class LottoClientFactory
{
    /**
     * @var string
     */
    private $wsdl;

    /**
     * @param string $wsdl
     */
    public function __construct($wsdl)
    {
        $this->wsdl = $wsdl;
    }

    /**
     * @return LottoClient
     */
    public function createLottoClient()
    {
        $client = new SoapClient(
            $this->wsdl,
            array(
                'trace'     => true,
                'exception' => false
            )
        );
        return new LottoClient($client);
    }
}
