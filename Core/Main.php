<?php
namespace App\Core;

use App\Controllers\MainController;

/**
 * Router principal
 */
class Main
{
    public function start()
    {
        //On retire le "trailing slash" eventuel de l'URL
        //On recupère l'URL
        $uri = $_SERVER['REQUEST_URI'];
        
        //On vérifie que uri n'est pas vide et se termine par un /
        if(empty($uri) && $uri != "/" && $uri[-1] === "/"){
            //On enlèvelent /
            $uri = substr($uri, 0, -1);
            echo $uri;

            // On envoie un code de redirection permanente
            http_response_code(301);

            // On rediriger vers l'URL sans /
            header('Location: ' . $uri);
            
        }

        // On gère les paramètres d'URL
        // p=controlleur/methode/paramètres
        // On sépare les paramètres dans un tableau 

            $params = explode('/',$_GET['p']);

        if($params[0] != ''){
            //On a au moins 1 paramètre
            //On récupère le nom du controleur à instancier
            //On met une majuscule en 1ère lmettre, on ajoute le namespace complet avant et on ajoute le coller après.
            $controller = "\\App\\Controllers\\" . ucfirst(array_shift($params)) . "controller";

            //On instancie le contrôleur
            $controller = new $controller;

            //On récupère le deuxième paramètres d'URL
            $action = (isset($params[0])) ? array_shift($params) : "index";

            if(method_exists($controller, $action)){
                //S'il reste des paramètres on lestr pass à la méthode
                (isset($params[0])) ? call_user_func_array([$controller, $action],$params) : $controller->$action();
            }else{
                http_response_code(404);
                echo " La page recherchée n'existe pas.";
            }
            

        } else {
            
            //On a pas de paramètres
            //On instancie le contrôleur par defaut
            $controller = new MainController;

            //On appelle la méthode index
            $controller->index();

        }
    }
}
