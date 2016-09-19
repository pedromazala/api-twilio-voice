<?php

namespace EMiolo\Twilio;


class App
{
    /**
     * Inicia a aplicação reguperando a url base da aplicação.
     * A constante __BASE_URL__ é criada
     */
    public static function start()
    {
        $protocol = isset($_SERVER['HTTP_X_FORWARDED_PROTO']) ? $_SERVER['HTTP_X_FORWARDED_PROTO'] : 'http';
        $base_url = $_SERVER['HTTP_HOST'];
        define('__BASE_URL__', $protocol . '://' . $base_url . '/');
    }

    /**
     * Retorna os parâmetros passados na url
     *
     * @return array
     */
    public static function getParameters()
    {
        $params = explode("/", $_SERVER['REQUEST_URI']);

        foreach ($params as $k => $p) {
            if (strlen($p) == 0) {
                unset($params[$k]);
            } else {
                continue;
            }
        }

        return $params;
    }

    /**
     * Verifica se a constante DEBUG está criada e setada como true
     *
     * @return bool
     */
    public static function isDebug()
    {
        if ((defined('TWILIO_DEBUG') && TWILIO_DEBUG) || !((bool) env('TWILIO_SSL'))) {
            return true;
        }

        return false;
    }
}