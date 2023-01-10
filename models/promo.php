<?php
// inclusion de la connexion a la base donnée 
require_once("conf.php");
// inclusion de la connexion à la classe Professeur pour acceder au informations des professeurs
require_once("professeur.php");
// définir une class (Promo) en PHP (la meme syntax qu'une fonction sans ())
// pour declarer une class il faut mettre la 1ére lettre en majuscule
class Promo
{
    /* public = visiblité
       private = non visible
    */
    // declaration d'une propriété (propriété = variable dans une class ($nom))
    public int $id_classe;
    public int $id_professeur;
    public string $nom;
    public string $niveau;
    public Professeur $prof_principal;
    // afficher les infos de tout les eleves sous formes de tableau
    // voir lien page eleves.php (ligne 35)
    function afficherInfos()
    {
        echo "<tr>";
        echo "<td>" . $this->nom . "</td>";
        echo "<td>" . $this->niveau . "</td>";
        echo "<td>" . $this->id_classe . "</td>";
        echo "<td>" . $this->id_professeur . "</td>";
        echo "<td>" . $this->prof_principal->nom . "</td>";
        echo "</tr>";
    }
    // Création d'une méthode statique, qui concerne le concept d'Eleve en générale, afin de récupérer la liste des eleves !!
    static function readAll(): array
    {
        // permet d'aller chercher la variable $pdo  à l'exterieur de la fonction (portée globale) -> (voir le require ligne 3)
        global $pdo;
        // L'ecriture de la requete SQL dans une chaine de caractères 
        $sql="SELECT nom, niveau, id_classe, id_professeur 
            FROM classes
            ";

        // Préparation de la requete SQL par PDO 
        $statement = $pdo->prepare($sql);

        // Execution de la requete
        $statement->execute(); 

        // Récupération des resultats de la requete, sous forme de  tableau  associatif FETCH_ASSOC (ici)
        $promos= $statement->fetchAll(PDO::FETCH_CLASS, "Promo");

        foreach($promos as $promo)
        {
            // TODO: charger les information du professeur principal $prof_principal

            // on va chrager les informations du professeur principal selectionné grace à la  propriété id_professeur de mon objet Promo
            $prof_principal = Professeur::readOne($promo->id_professeur);
            // enregistrons les informations du professeur principal dans la propriété prof_principal 
            $promo->prof_principal = $prof_principal;
        }

        // on affiche le tableau associatif 
        // echo "<pre>";
        // var_dump($promo);
        // echo "</pre>";
        
        // pemet que la fonction redAll de retournes les informations et la listes des eleves (lien eleves.php = ligne 5)
        return $promos;
    }
}