<?php

namespace EMiolo\Twilio\App\Message;

use EMiolo\Twilio\App\Pattern\ServicePattern;
use Twilio\Rest\Api\V2010\Account\MessageInstance;

class Sms extends ServicePattern
{
    /**
     * Envia SMS para o cliente
     *
     * @param $to
     * @param $body
     * @param null $from
     * @param null $params
     * @return MessageInstance
     */
    public function perform($to, $body, $from = null, $params = null)
    {
        if (is_null($from)) {
            print "Get \$from dynamically is not implemented yet.";
        }

        if (is_null($params)) {
            $params = $this->params;
        }

        $params = array_merge(
            [
                'from' => $from,
                'body' => $body,
            ],
            $params
        );
        foreach ($params as $key => $param) {
            if (is_null($param)) {
                unset($params[$key]);
            }
        }

        /**
         * @var $message MessageInstance
         */
        $message = $this->service->getClient()->messages->create(
            $to,
            $params
        );

        return $message;
    }
}