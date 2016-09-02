<?php
/**
 * Created by PhpStorm.
 * User: emiolo
 * Date: 02/09/16
 * Time: 08:34
 */

namespace EMiolo\Twilio\App\Pattern;

use EMiolo\Twilio\App\Call;
use EMiolo\Twilio\App\Exception\PerformedCallException;

class CallFlow
{
    /**
     * @var Call
     */
    protected $call;

    /**
     * CallFlow constructor.
     *
     * @param Call $call
     * @throws PerformedCallException
     */
    public final function __construct(Call $call)
    {
        if (is_null($call->getPerformedCall())) {
            throw new PerformedCallException();
            die();
        }

        $this->call = $call;
    }

    public function start()
    {
        $response = new \Services_Twilio_Twiml();

        $saySettings = [
            'language' => "pt-BR",
            'voice' => "alice"
        ];

        $response->say("Olá, esta é a api de utilização da ferramenta Twilio criada pela eMiolo.", $saySettings);
        $response->say("Qualquer dúvida, entre em contado pelo e-mail: suporte@emiolo.com!", $saySettings);
        $response->say("Até mais.", $saySettings);

        print $response;
    }
}