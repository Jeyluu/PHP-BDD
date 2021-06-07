<?php

$titrePage = "accueil";

//On définit une constante contenant le dossier racine du projet.

use App\Autoloader;
use App\Core\Main;
use App\Models\UsersModel;

define('ROOT',dirname(__DIR__));

//On importe l'autoloader
require_once ROOT.'/Autoload.php';
Autoloader::register();

//On instancie Main
$app = new Main();

//On démarre l'application
$app->start();


?>

