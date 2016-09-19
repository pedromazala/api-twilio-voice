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
        $this->client = new \Services_Twilio($sid, $token);

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