<?php

define('__ROOT__', __DIR__ . DIRECTORY_SEPARATOR);

$protocol = $_SERVER['HTTP_X_FORWARDED_PROTO'];
$base_url = $_SERVER['HTTP_HOST'];
define('__BASE_URL__', $protocol . '://' . $base_url . '/');

require_once __ROOT__ . "vendor/autoload.php";


\EMiolo\Twilio\Helper\Debugger::dd('fallback.html', $_REQUEST);

$voiceParameters = 'language="pt-BR" voice="alice"';

// now greet the caller
header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <Say <?= $voiceParameters ?>>Ops... Desculpe-nos. Algo inesperado aconteceu.</Say>
    <Say <?= $voiceParameters ?>>Aparentemente, estamos com algum problema nesta opção.</Say>
    <Say <?= $voiceParameters ?>>Mas não se preocupe. Um de nossos técnicos logo irá sanar este sinistro.</Say>
    <Pause></Pause>
    <Say <?= $voiceParameters ?>>Você será transferido para o início da chamada</Say>
    <Redirect><?= __BASE_URL__; ?>hello.php</Redirect>
</Response>