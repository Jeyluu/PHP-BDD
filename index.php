<?php

use App\Autoloader;
use App\Models\AnnoncesModel;

require_once 'Autoload.php';
Autoloader::register();

$model = new AnnoncesModel;

$annonces = $model->find(2);
var_dump($annonces);

?>

