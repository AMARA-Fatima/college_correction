<?php
// inclusion de la connexion a la base donnée 
require_once("conf.php");
// notre class Eleve herite de la class Personne, voici la connexion
require_once("personne.php");
// définir une class (Eleve) en PHP (la meme syntax qu'une fonction sans ())
// pour declarer une class il faut mettre la 1ére lettre en majuscule
// la class Eleve herite de la class Personne
class Eleve extends Personne
{
    /* public = visiblité
       private = non visible
    */
    // declaration d'une propriété (propriété = variable dans une class ($nom))
    public string $date_naissance;
    // création d'une propriété statique qui sera commune à tous mes eleves
    public static $nombre = 0;

    function __construct()
    {
        // incrementer le nombre des élèves +1 (on ajoute 1 à chaque création d'eleve)
        self::$nombre++;
    }
    // afficher les infos de tout les eleves sous formes de tableau
    // voir lien page eleves.php (ligne 35)
    function afficherInfos()
    {
        echo "<tr>";
        echo "<td>" . $this->nom . "</td>";
        echo "<td>" . $this->prenom . "</td>";
        echo "<td>" . $this->date_naissance . "</td>";
        echo "</tr>";
    }
    // Création d'une méthode statique, qui concerne le concept d'Eleve en générale, afin de récupérer la liste des eleves !!
    static function readAll(): array
    {
        // permet d'aller chercher la variable $pdo  à l'exterieur de la fonction (portée globale) -> (voir le require ligne 3)
        global $pdo;
        // L'ecriture de la requete SQL dans une chaine de caractères 
        $sql ="SELECT nom, prenom, date_naissance FROM eleves ";

        // Préparation de la requete SQL par PDO 
        $statement = $pdo->prepare($sql);

        // Execution de la requete
        $statement->execute(); 

        // Récupération des resultats de la requete, sous forme de  tableau  associatif FETCH_ASSOC (ici)
        $eleves = $statement->fetchAll(PDO::FETCH_CLASS, "Eleve");

        // on affiche le tableau associatif 
        // echo "<pre>";
        // var_dump($eleves);
        // echo "</pre>";
        
        // pemet que la fonction redAll de retournes les informations et la listes des eleves (lien eleves.php = ligne 5)
        return $eleves;
    }
}