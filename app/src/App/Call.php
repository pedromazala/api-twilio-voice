<?php
/**
 * Created by PhpStorm.
 * User: emiolo
 * Date: 02/09/16
 * Time: 09:06
 */

namespace EMiolo\Twilio\App;

class Call
{
    /**
     * @var Service
     */
    protected $service;

    /**
     * @var \Services_Twilio_InstanceResource
     */
    protected $performedCall;

    /**
     * Call constructor.
     *
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Construtor alternativo
     *
     * @param $sid
     * @param $token
     *
     * @return Call
     */
    public static function getCall($sid, $token)
    {
        $service = new Service($sid, $token);

        return new static($service);
    }

    /**
     * Cria uma nova ligação para o cliente
     *
     * @param $to
     * @param $url
     * @param null $from
     * @param null $params
     *
     * @return \Services_Twilio_InstanceResource
     */
    public function perform($to, $url, $from = null, $params = null)
    {
        if (is_null($from)) {
            print "Get \$from dynamically is not implemented yet.";
        }

        if (is_null($params)) {
            $params = [
                'FallbackUrl' => __BASE_URL__ . "fallback.php",

                'StatusCallback' => __BASE_URL__ . "events.php",
                'StatusCallbackMethod' => "POST",
                'StatusCallbackEvent' => [
                    "initiated", "ringing", "answered", "completed"
                ],
            ];
        }

        /**
         * @var $call \Services_Twilio_InstanceResource
         */
        $call = $this->service->getClient()->account->calls->create(
            $from,
            $to,
            $url,
            $params
        );

        return $call;
    }

    /**
     * @return Service
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param string $callSid
     */
    public function setPerformedCall($callSid)
    {
        $this->performedCall = $this
            ->service
            ->getClient()
            ->account
            ->calls
            ->get($callSid);
    }

    /**
     * @return \Services_Twilio_InstanceResource
     */
    public function getPerformedCall()
    {
        return $this->performedCall;
    }
}