<?php

namespace EMiolo\Twilio\App\Pattern;

use EMiolo\Twilio\App\Service;

class ServicePattern
{
    /**
     * @var Service
     */
    protected $service;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * Sms constructor.
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
     * @return static
     */
    public static function get($sid, $token)
    {
        $service = new Service($sid, $token);

        return new static($service);
    }

    /**
     * @return Service
     */
    public function getService()
    {
        return $this->service;
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