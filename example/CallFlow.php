<?php
/**
 * Created by PhpStorm.
 * User: emiolo
 * Date: 02/09/16
 * Time: 10:24
 */

namespace EMiolo\Example;

use EMiolo\Twilio\App\Pattern\CallFlow as CallFlowPattern;

class CallFlow extends CallFlowPattern
{
    public function run()
    {
        $response = new \Services_Twilio_Twiml();

        $saySettings = [
            'language' => "pt-BR",
            'voice' => "alice"
        ];

        $response->say("Olá, esta é a api de utilização da ferramenta Twilio criada pela eMiolo.", $saySettings);
        $response->say("Qualquer dúvida, entre em contado pelo e-mail: suporte @ emiolo ponto com.", $saySettings);
        $response->say("Até mais.", $saySettings);

        print $response;
    }
}