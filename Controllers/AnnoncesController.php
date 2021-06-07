<?php

namespace App\Controllers;

use App\Models\AnnoncesModel;

class AnnoncesController extends Controller
{
    /**
     * Cette méthode affichera une page lisant toutes les annonces de la base de données
     * @return void
     */
    public function index()
    {
        //On instancie le modèle correspondant à la table 'annonces'
        $annoncesModel = new AnnoncesModel;

        // On va chercher toutes les annonces actives
        $annonces = $annoncesModel->findBy(['actif' => 1] );

        //On génére la vue
        $this->render("annonces/index", compact("annonces"));

        
    }
    /**
     * Affiche 1 annonce
     * @param int $id Id de l'annonce
     * @return void
     */
    public function lire(int $id)
        {
            //On instancie le modèle
            $annoncesModel = new AnnoncesModel;

            //On va chercher 1 annonce
            $annonce = $annoncesModel->find($id);

            //On envoi à la vue
            $this->render('annonces/lire', compact('annonce'));
        }
}

?>