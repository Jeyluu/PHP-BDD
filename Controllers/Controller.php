<?php
namespace App\Controllers;

abstract class Controller
{
    public function render(string $fichier,array $donnees = [], string $template = 'default')
    {
        
        //On extrait le contenu de $donnees
        extract($donnees);

        //On démarre le buffeur de sortie
        ob_start();

        //A partir de ce point toutes sorties est conservée en mémoire.
        
        //On crée le chemin vers la vue
        require_once ROOT. '/views/'.$fichier.'.php';

        //Transfert notre buffeur dans $contenu
        $contenu = ob_get_clean(); // Cette fonction prend le buffeur et le stock dans la variable. (tout ce qui est entre OB start et ob get clean.)
        
        //Template page
        require_once ROOT."/Views/".$template.".php";
    }
}

?>