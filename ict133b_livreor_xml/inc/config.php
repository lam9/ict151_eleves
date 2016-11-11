<?php
//Mode debug
define('DEBUG_MODE', true);

if (DEBUG_MODE) {
    require_once 'vendors/php-ref-master/ref.php';
    //error_reporting(E_ALL & ~E_NOTICE);
    error_reporting(E_ALL);
    //http://php.net/manual/fr/function.error-reporting.php
} else {
    error_reporting(0);
}

//Données site et utilisateur
define('SITE_NAME',     'Livre d\'Or');
define('USER_NAME',     'Steve Fallet');
define('USER_EMAIL',    'steve.fallet@divtec.ch');

//Dossier racine de l'application
define('ROOT_DIR',      __DIR__ . '/../');

//Dossiers des models, vues et parties de vues
define('MODEL_DIR',      ROOT_DIR . 'model/');
define('VIEW_DIR',  ROOT_DIR . 'view/');
define('VIEW_PART_DIR',  VIEW_DIR . 'part/');

//Dossiers images
define('IMG_DIR',       ROOT_DIR . 'img/');

//Fichiers de données
define('MESSAGES_PATH', ROOT_DIR . 'data/messages.xml');


//URL de départ de l'application
define('ROOT_URL', pathUrl(ROOT_DIR));
//URLs Images
define('IMG_URL', ROOT_URL . 'img/');

//Locales (fuseau horaire et langue)
date_default_timezone_set('Europe/Zurich');
setlocale(LC_TIME, 'fr', 'fr_FR', 'fra');