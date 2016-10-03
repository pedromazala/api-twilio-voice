<?php

namespace EMiolo\Example;

use EMiolo\Twilio\App\Voice\Call;
use EMiolo\Twilio\App\Voice\Pattern\CallFlow as CallFlowPattern;
use EMiolo\Twilio\App\Voice\Response;

class CallFlow extends CallFlowPattern
{
    public function __construct(Call $call)
    {
        $this->setCall($call);
    }

    public function run()
    {
        $response = new Response();

        $saySettings = [
            'language' => "pt-BR",
            'voice' => "alice"
        ];

        $response->say("Olá, esta é a A P I de utilização da ferramenta Twilio criada pela eMiolo.", $saySettings);
        $response->say("Qualquer dúvida, entre em contado pelo e-mail: suporte @ emiolo ponto com.", $saySettings);
        $response->say("Até mais.", $saySettings);

        print $response;
    }
}