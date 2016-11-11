<?php

/**
* Get real URL of a full path
*
* /home/1d4i8id/web/tests/ > https://myweb.com/tests
* /Users/johnsmith/Documents/myweb/tests > http://localhost/alias-name/tests
*
* @param string $dir   dir path, default __DIR__
* @return string       dir URL with trailing slash
*/
function pathUrl($dir = __DIR__){
    $root = "";
    $dir = realpath($dir);

    //HTTPS or HTTP
    $root .= !empty($_SERVER['HTTPS']) ? 'https' : 'http';

    //HOST
    $root .= '://' . $_SERVER['HTTP_HOST'];

    //ALIAS
    if(isset($_SERVER['CONTEXT_PREFIX'])) {
        $root .= $_SERVER['CONTEXT_PREFIX'];
        $root .= '/';
        $root .= substr($dir, strlen($_SERVER[ 'CONTEXT_DOCUMENT_ROOT' ]));
    } else {
        $root .= substr($dir, strlen($_SERVER[ 'DOCUMENT_ROOT' ]));
    }

    $root .= '/';

    return $root;
}

/**
 * Retourne la chaîne date/heure passée en paramètre au format date/heure locale demandé
 *
 * @param string $time      chaîne date/heure en anglais
 * @param string $format    format de date/heure locale http://strftime.net
 * @return string           chaîne date/heure au format local encodée en UTF8
 */
function localDate($time = 'now', $format = '%d %B %Y') {
    return utf8_encode(strftime($format,strtotime($time)));
}
