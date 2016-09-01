<?php

define('__ROOT__', __DIR__ . DIRECTORY_SEPARATOR);

$protocol = $_SERVER['HTTP_X_FORWARDED_PROTO'];
$base_url = $_SERVER['HTTP_HOST'];
define('__BASE_URL__', $protocol . '://' . $base_url . '/');

require_once __ROOT__ . "vendor/autoload.php";

// M-Gov
$sid = "ACda019482cdeb6b0ce50e0ae710ce8af0";
$token = "c2590e5e650e7c1b2e21891196314b7c";
$from = "+551149502223";

// eMiolo
$sid = "AC207fb2661446d1c3d8c68150eeacf5ed";
$token = "ab2c982bd4b770029862741c2d298957";
$from = "+5532999743335";

// if the caller pressed anything but 1 send them back
if (!in_array($_REQUEST['Digits'], [1, 2, 3, 4])) {
    header("Location: hello.php");
    die;
}

$client = new Services_Twilio($sid, $token, null);
$client->http->debug = true;

\Acme\Debbuger::dd('other.html', $_REQUEST);

$voiceParameters = 'language="pt-BR" voice="man"';

// the user pressed 1, connect the call to 310-555-1212
header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

print '<Response>';

switch ($_REQUEST['Digits']) {
    case 1: {
        ?>
        <Play>http://demo.twilio.com/hellomonkey/monkey.mp3</Play>
        <Say <?= $voiceParameters ?>>A verdade é que, infelizmente, não temos um macaco de verdade.</Say>
        <?php
        break;
    }
    case 2: {
        ?>
        <Play><?= __BASE_URL__; ?>song.mp3</Play>
        <?php
        break;
    }
    case 3: {
        ?>
        <Say <?= $voiceParameters ?>>Error!
        <?php
        break;
    }
    case 4: {
        $call = $client->account->calls->get($_REQUEST['CallSid']);

        $saveLocation = implode(DIRECTORY_SEPARATOR, ["savedCalls", $call->sid . '.json']);

        $callArray = ['passed' => 0];
        if (!file_exists($saveLocation)) {
            \Acme\Debbuger::ds($saveLocation, json_encode($callArray));
        }
        $callArray = (array)json_decode(file_get_contents($saveLocation));
        $callArray['passed']++;
        \Acme\Debbuger::ds($saveLocation, json_encode($callArray));

        ?>
        <Say <?= $voiceParameters ?>>É a <?= $callArray['passed']; ?>ª vez que você salva seu caminho</Say>
        <Redirect><?= __BASE_URL__; ?>hello.php</Redirect>
        <?php
        break;
    }
}

print '</Response>';
