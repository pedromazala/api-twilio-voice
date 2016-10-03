<?php

namespace EMiolo\Twilio\App\Voice;

use EMiolo\Twilio\App\Pattern\ServicePattern;
use Twilio\Rest\Api\V2010\Account\CallInstance;

class Call extends ServicePattern
{

    /**
     * @var CallInstance
     */
    protected $performedCall;

    /**
     * Construtor alternativo
     *
     * @param $sid
     * @param $token
     *
     * @return ServicePattern|Call
     */
    public static function getCall($sid, $token)
    {
        return parent::get($sid, $token);
    }

    /**
     * Cria uma nova ligação para o cliente
     *
     * @param $to
     * @param $url
     * @param null $from
     * @param null $params
     *
     * @return CallInstance
     */
    public function perform($to, $url, $from = null, $params = null)
    {
        if (is_null($from)) {
            print "Get \$from dynamically is not implemented yet.";
        }

        if (is_null($params)) {
            $params = $this->params;
        }

        $params = array_merge(['url' => $url], $params);
//var_dump($params);exit;
        /**
         * @var $call CallInstance
         */
        $call = $this->service->getClient()->calls->create(
            $to,
            $from,
            $params
        );

        return $call;
    }

    /**
     * @param string $callSid
     */
    public function setPerformedCall($callSid)
    {
        $this->performedCall = $this
            ->service
            ->getClient()
            ->calls($callSid)
            ->fetch();
    }

    /**
     * @return CallInstance
     */
    public function getPerformedCall()
    {
        if (is_null($this->performedCall) && isset($_REQUEST['CallSid'])) {
            $this->setPerformedCall($_REQUEST['CallSid']);
        }

        return $this->performedCall;
    }
}