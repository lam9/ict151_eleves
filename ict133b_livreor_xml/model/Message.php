<?php
/**
 * Retourne un tableau contenant tous les messages du livre d'or
 *
 * @return Array  Tableau associatif de messages ou tableau vide
 */
function allMessage() {
    /*$xml= simplexml_load_file(MESSAGE_URL) or die("Error: Cannot create object");
    return $xml->children();*/

    if (!file_exists(MESSAGES_PATH)) {
        header('Location: '.ROOT_URL.'500.html');
        exit;
    }

    //Reourne l'élément principal <messages> sous forme d'un objet SimpleXMLElement
    $xmlFile = simplexml_load_file(MESSAGES_PATH);

    //Si pas de messages
    if($xmlFile->count() == 0) {
        return [];
    }

    //Encode le tableau d'objets au format JSON
    $json = json_encode($xmlFile);
    //Decode le JSON en tableau associatif (car 2e paramètre à TRUE)
    $tabAssoc = json_decode($json, TRUE);

    //Si un seul message
    if($xmlFile->count() <= 1) {
        return $tabAssoc;
    }

    return $tabAssoc['message'];
}

/**
 * Valide les informations du message saisi par le visiteur via le formulaire.
 *
 * @param  array $contact    tableau des infos du message (auteur, titre, message, date)
 * @return array             tableau de messages d'erreurs. Tableau vide si tout est ok.
 */
function validMessage ($message = []) {
    $errors = [];

    //Champs obligatoire
    if (!$message['auteur']) {
        $errors[] = "Entrez votre nom et prénom";
    }

    if (!$message['titre']) {
        $errors[] = "Entrez un titre pour votre message";
    }

    if (!$message['message']) {
        $errors[] = "Entrez votre message";
    }

    return $errors;
}


/**
 * Ajoute le messsage passé en paramètre dans le fichier XML
 *
 * @param array $message    tableau contenant les données du message : auteur, titre, message, date
 */
function addMessage ($message = []) {
    /*
     * Création du objet DOMDocument qui permet de manipuler, représenter un document HTML ou XML
     *
     * http://php.net/manual/fr/class.domnode.php
     * http://stackoverflow.com/questions/3797300/simplexmladdchild-cant-add-line-break-when-output-to-a-xml
     */

    //Si document XML introuvable > erreur 500
    if (!file_exists(MESSAGES_PATH)) {
        header('Location: '.ROOT_URL.'500.html');
        exit;
    }

    //Crée un objet DOMDocument
    $xmlDoc = new DOMDocument();
    //Formate élégamment le résultat avec une indentation et des espaces supplémentaires. Vaut par défaut FALSE.
    $xmlDoc->formatOutput = true;
    //Supprimer les espaces redondants. Vaut par défaut TRUE.
    $xmlDoc->preserveWhiteSpace = false;

    //Charge le document XML
    $xmlDoc->load(MESSAGES_PATH);

    //Création du nouvel élément message : <message></message>
    $newMessage = $xmlDoc->createElement('message');

    //Créer et ajoute au nouveau message un élément auteur avec valeur : <auteur>Jean Némarre</auteur>
    $newMessage->appendChild($xmlDoc->createElement('auteur',$message['auteur']));
    //Même chose pour le titre
    $newMessage->appendChild($xmlDoc->createElement('titre',$message['titre']));
    //Même chose pour le message
    $newMessage->appendChild($xmlDoc->createElement('message',$message['message']));
    //Même chose pour la date
    $newMessage->appendChild($xmlDoc->createElement('date',$message['date']));

    //Ajoute le nouveau <message> au noeud racine : <messages>
    $xmlDoc->getElementsByTagName('messages')->item(0)->appendChild($newMessage);

    //Sauvegarde le document XML
    $xmlDoc->save(MESSAGES_PATH);
}