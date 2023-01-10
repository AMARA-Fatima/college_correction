<?php
// inclusion de la connexion a la base donnée 
require_once("conf.php");
// notre class Eleve herite de la class Personne, voici la connexion
require_once("personne.php");
// définir une class (Eleve) en PHP (la meme syntax qu'une fonction sans ())
// pour declarer une class il faut mettre la 1ére lettre en majuscule
// la class Eleve herite de la class Personne
class Professeur extends Personne
{
    /* public = visiblité
       private = non visible
    */
    // declaration d'une propriété (propriété = variable dans une class ($nom))
    public string $email;
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
        echo "<td>" . $this->email . "</td>";
        echo "</tr>";
    }
    // Création d'une méthode statique, qui concerne le concept d'une classe en générale, afin de récupérer la liste des eleves !!
    static function readAll(): array
    {
        // permet d'aller chercher la variable $pdo  à l'exterieur de la fonction (portée globale) via conf.php
        global $pdo;
        // L'ecriture de la requete SQL dans une chaine de caractères 
        $sql = "SELECT nom, prenom, email FROM professeurs ";

        // Préparation de la requete SQL par PDO 
        $statement = $pdo->prepare($sql);

        // Execution de la requete
        $statement->execute();

        // Récupération des resultats de la requete, sous forme de  tableau associatif grace à FETCH_ASSOC (ici)
        $professeurs = $statement->fetchAll(PDO::FETCH_CLASS, "Professeur");

        // on affiche le tableau associatif 
        // echo "<pre>";
        // var_dump($eleves);
        // echo "</pre>";

        // pemet que la fonction redAll de retournes les informations et la listes des eleves (lien eleves.php = ligne 5)
        return $professeurs;
    }

    // Création d'une méthode statique, qui concerne le concept d'un professeur en particulier, afin de récupérer ses informations
    static function readOne(int $id): Professeur
    {
        // permet d'aller chercher la variable $pdo  à l'exterieur de la fonction (portée globale) via conf.php
        global $pdo;
        // L'ecriture de la requete SQL dans une chaine de caractères 
        $sql = "SELECT nom, prenom, email 
                FROM professeurs 
                -- utilisation d'un parametre nommé :id pour se proteger des injection SQL (anti piratage) -- 
                WHERE id_professeur = :id
                ";

        // Préparation de la requete SQL par PDO 
        $statement = $pdo->prepare($sql);

        // lien entre le parametre :id et la variable $id qui sont de type INT (:id récupère ses infos dans $id)
        $statement->bindParam(":id", $id, PDO::PARAM_INT);

        // Execution de la requete
        $statement->execute();

        // Récupération du resultat de la requete, sous forme d'un objet professeur grace à FETCH (ici)
        $statement->setFetchMode(PDO::FETCH_CLASS, 'Professeur');
        $professeurs = $statement->fetch();
        
        // on affiche le tableau associatif 
        // echo "<pre>";
        // var_dump($eleves);
        // echo "</pre>";

        // pemet que la fonction redAll de retournes les informations et la listes des eleves (lien eleves.php = ligne 5)
        return $professeurs;
    }
}
