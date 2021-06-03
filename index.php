<?php

use App\Autoloader;
use App\Models\UsersModel;

require_once 'Autoload.php';
Autoloader::register();

$model = new UsersModel;

$user = $model->setEmail('contact@jeanguy.com')
->setPassword(password_hash('azerty', PASSWORD_BCRYPT));

$model->create($user);

// var_dump($annonce);

?>

