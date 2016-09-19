<?php
/**
 * Created by PhpStorm.
 * User: emiolo
 * Date: 01/09/16
 * Time: 17:13
 */

namespace EMiolo\Twilio\App;

use EMiolo\Twilio\App;

class Service
{
    /**
     * @var \Services_Twilio
     */
    protected $client;

    public function __construct($sid, $token)
    {
        $http = null;
        if (App::isDebug()) {
            $http = new \Services_Twilio_TinyHttp(
                'https://api.twilio.com',
                [
                    'curlopts' => [
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_SSL_VERIFYHOST => 2,
                    ]
                ]
            );
        }
        $this->client = new \Services_Twilio($sid, $token, null, $http);

        if (App::isDebug()) {
            $this->client->http->debug = true;
        }
    }

    /**
     * @return \Services_Twilio
     */
    public function getClient()
    {
        return $this->client;
    }
}