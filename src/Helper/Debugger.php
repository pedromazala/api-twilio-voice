<?php
/**
 * Created by PhpStorm.
 * User: emiolo
 * Date: 29/08/16
 * Time: 17:38
 */

namespace EMiolo\Twilio\Helper;


class Debugger
{
    /**
     * Salva os parâmetros passados no PATH ('log' . DIRECTORY_SEPARATOR . $filename)
     * adicionando as tags <pre>
     *
     * @param $filename
     * @param array ...$debug
     */
    public static function dd($filename, ...$debug)
    {
        ob_start();

        print '<pre>' . PHP_EOL;
        var_dump($debug) . PHP_EOL;
        print '</pre>' . PHP_EOL;

        $contents = ob_get_contents();
        ob_end_clean();

        file_put_contents(__ROOT__ . 'log' . DIRECTORY_SEPARATOR . $filename, $contents);
    }

    /**
     * Salva o conteúdo da variável $contents em $filename
     *
     * @param $filename
     * @param $contents
     */
    public static function ds($filename, $contents)
    {
        ob_start();
        print $contents;
        $contents = ob_get_contents();
        ob_end_clean();

        file_put_contents(__ROOT__ . $filename, $contents);
    }
}