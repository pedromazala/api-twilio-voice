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
     * @var array
     */
    protected $params = [];

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
            $params = $this->params;
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
        if (is_null($this->performedCall) && isset($_REQUEST['CallSid'])) {
            $this->setPerformedCall($_REQUEST['CallSid']);
        }

        return $this->performedCall;
    }

    /**
     * Escolhe os parâmetros que serão utilizados na ligação
     *
     * @param array $params
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * Método utilizado para setar um parêmetro em específico ou adicionar um novo
     *
     * @param string $key
     * @param mixed $value
     */
    public function addParam($key, $value)
    {
        $this->params[$key] = $value;
    }
}