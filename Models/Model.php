<?php
namespace App\Models;

use App\Db\Db;

class Model extends Db
{
    // Table de la base de données
    protected $table;

    // Instance de Db
    private $db;

    public function findAll()
    {
        $query = $this->requete('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }

    public function findBy(array $criteres)
    {
        $champs = [];
        $valeurs = [];

        //On boucle pour éclater le tableau
        foreach($criteres as $champ => $valeur){
            //SELECT * FROM annonces WHERE actif = ? AND signale = ?
            //bindValue(1, valeur)
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;

            
        }

        // On transforme le tableau "champs" en une chaine de caractères
        $liste_champs = implode(' AND ', $champs);
        
        //On execute la requête
        return $this->requete('SELECT * FROM ' . $this->table . ' WHERE ' . $liste_champs, $valeurs)->fetchAll();
    }

    public function find(int $id)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
    }

    public function requete(string $sql, array $attributs = null)
    {
        //On recupère l'instance Db
        $this->db = Db::getInstance();

        //On vérifie si on a des attributs
        if($attributs !== null){
            //requête préparée
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {
            //requête simple
            return $this->db->query($sql);
        }
    }
}

?>