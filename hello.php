<?php

define('__ROOT__', __DIR__ . DIRECTORY_SEPARATOR);
require_once __ROOT__ . "vendor/autoload.php";

$sid = "ACda019482cdeb6b0ce50e0ae710ce8af0";
$token = "c2590e5e650e7c1b2e21891196314b7c";

$sid = "AC207fb2661446d1c3d8c68150eeacf5ed";
$token = "ab2c982bd4b770029862741c2d298957";

$to = isset($_GET['to']) ? $_GET['to'] : '+5532999273553';

$http = new Services_Twilio_TinyHttp(
    'https://api.twilio.com',
    array('curlopts' => array(
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
    ))
);

$client = new Services_Twilio($sid, $token, null, $http);
$client->http->debug = true;

$caller_id = $client->account->outgoing_caller_ids->get($_REQUEST['CallSid']);

\Acme\Debbuger::dd('hello.html', $caller_id, $_REQUEST);

$voiceParameters = 'language="pt-BR" voice="alice"';

// now greet the caller
header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <Say <?= $voiceParameters ?>>Olá eMiolo.</Say>
    <Gather numDigits="1" action="other.php" method="POST">
        <Say <?= $voiceParameters ?>>Para falar com um macaco de verdade, digite 1.</Say>
        <Say <?= $voiceParameters ?>>Para ouvir uma boa música, digite 2.</Say>
        <Say <?= $voiceParameters ?>>Para entrar em uma página com erro, digite 3.</Say>
        <Pause></Pause>
        <Say <?= $voiceParameters ?>>Para ouvir as opções novamente, digite outro número.</Say>
        <Pause></Pause>
    </Gather>
</Response>