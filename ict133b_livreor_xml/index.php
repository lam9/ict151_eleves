<?php
require_once 'inc/utils.php';
require_once MODEL_DIR . 'Message.php';

//Initialisation du tableau des erreurs
$errors = [];

//Initialisation du tableau qui contiendra les données de contact (name, email, message, copy)
$nouveauMsg = [];
$nouveauMsg['auteur']    = '';
$nouveauMsg['titre']   = '';
$nouveauMsg['message'] = '';

//Si la page est appelée par un formulaire : on récupère, nettoye et valide les données
if(isset($_POST['submit'])){

    //Supprime les espaces superflus en début et fin de chaine pour tous les éléments du tableau $_POST
    $_POST = array_map("trim", $_POST);

    /*
     * Récupération et nettoyage des données du formulaire
     *  - srip_tags nous protège du XSS en supprimant les balises HTML
     *  - htmlspecialchars encode les caractères spéciaux en enttité HTML. Ex : < devient &lt;
     *
     * Exemple de valeur à tester  : L'épave < > & <?php  <strong>test</strong> ä <script>script</script>
     */
    $nouveauMsg['auteur']  = htmlspecialchars(strip_tags($_POST['auteur']));
    $nouveauMsg['titre']   = htmlspecialchars(strip_tags($_POST['titre']));
    $nouveauMsg['message'] = htmlspecialchars(strip_tags($_POST['message'],'<strong><u><a>'));
    $nouveauMsg['date']    = date('Y-m-d');

    //Valide les données saisies par le visiteur
    $errors = validMessage($nouveauMsg);

    //Si il n'y a PAS d'erreurs : on redirige le visiteur vers la page de confirmaation
    if(!$errors) {
        addMessage($nouveauMsg);
        $nouveauMsg['auteur']    = '';
        $nouveauMsg['titre']   = '';
        $nouveauMsg['message'] = '';
    }
}

//Données de la vue
$pageTitle = "Accueil";
$messages = allMessage();

include VIEW_DIR.'home.php';