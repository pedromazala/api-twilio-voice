<?php

namespace EMiolo\Twilio\App;

use EMiolo\Twilio\App;
use Twilio\Rest\Client;

class Service
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct($sid, $token)
    {
        $http = null;
        if (App::isDebug()) {
            /*
             * TODO: SSL escape
             */
//            $http = new \Services_Twilio_TinyHttp(
//                'https://api.twilio.com',
//                [
//                    'curlopts' => [
//                        CURLOPT_SSL_VERIFYPEER => false,
//                        CURLOPT_SSL_VERIFYHOST => 2,
//                    ]
//                ]
//            );
        }
        $this->client = new Client($sid, $token, null, $http);

        if (App::isDebug()) {
            $this->client->http->debug = true;
        }
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }
}