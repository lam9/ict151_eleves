<?php
require_once 'inc/utils.php';
require_once MODEL_DIR . 'Message.php';

/*
$simple = "<para><note>simple note</note></para>";
$p = xml_parser_create();
xml_parse_into_struct($p, $simple, $vals, $index);
xml_parser_free($p);
echo "Index array\n";
print_r($index);
echo "\nVals array\n";
r($vals);
*/




/*
$xmlFile = simplexml_load_file(MESSAGE_URL) or die("Error: Cannot create object");

$xml = simplexml_load_string($xmlFile->saveXML(), "SimpleXMLElement", LIBXML_NOCDATA);
$json = json_encode($xml);
$array = json_decode($json,TRUE);

r($array);


$xmlDoc = new DOMDocument();
$xmlDoc->preserveWhiteSpace = false;
$xmlDoc->formatOutput = true;
$xmlDoc->load(MESSAGE_URL);


$newMessage = $xmlDoc->createElement('message');

$newMessage->appendChild($xmlDoc->createElement('auteur','Steve Fallet'));

$messages = $xmlDoc->getElementsByTagName('messages')->item(0);
$messages->appendChild($newMessage);

$xmlDoc->save(MESSAGE_URL);
*/