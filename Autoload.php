<?php 
namespace App;

    class Autoloader
    {
        static function register(){
            
            spl_autoload_register([
                __CLASS__,
                'autoload'
            ]);
        }
        static function autoload($class)
        {   
            //On recupère dans $class la totalité du namepace de la classe concernée (App\client\Compte)
            //On retire App\ (Clients\Compte)
            $class = str_replace(__NAMESPACE__ . '\\', '',$class);

            //On remplace les \ par des /
            $class = str_replace('\\', '/', $class); 
            echo $class . "<br>";

            $fichier = __DIR__ . '/' . $class . '.php';
            //On vérifie si le fichier existe
            if(file_exists($fichier)){
                require_once $fichier;
            }
            
        }
    }
?>