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
        echo "<td>" . $this->niveau . "</td>";
        echo "<td>" . $this->nom . "</td>";
        echo "<td>" . $this->prof_principal->nom . "</td>";
        echo "<td>" . $this->prof_principal->prenom . "</td>";
        echo "<td>" . $this->prof_principal->email . "</td>";
        echo "<td>
                <a href=\"promoDetail.php?id=" . $this->id_classe . "\">
                <button>Aficher</button>
                </a>
            </td>";
        echo "</tr>";

    }
    // Création d'une méthode statique, qui concerne le concept d'Eleve en générale, afin de récupérer la liste des eleves !!
    static function readAll(): array
    {
        // permet d'aller chercher la variable $pdo  à l'exterieur de la fonction (portée globale) -> (voir le require ligne 3)
        global $pdo;
        // L'ecriture de la requete SQL dans une chaine de caractères 
        $sql = "SELECT nom, niveau, id_classe, id_professeur 
            FROM classes";

        // Préparation de la requete SQL par PDO 
        $statement = $pdo->prepare($sql);

        // Execution de la requete
        $statement->execute();

        // Récupération des resultats de la requete, sous forme de  tableau  associatif FETCH_ASSOC (ici)
        $promos = $statement->fetchAll(PDO::FETCH_CLASS, "Promo");

        foreach ($promos as $promo) {
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
    // Création d'une méthode statique, qui concerne le concept d'un professeur en particulier, afin de récupérer ses informations
    static function readOne(int $id): Promo
    {
        // permet d'aller chercher la variable $pdo  à l'exterieur de la fonction (portée globale) via conf.php
        global $pdo;
        // L'ecriture de la requete SQL dans une chaine de caractères 
        $sql = "SELECT nom, niveau, id_professeur 
                 FROM classes 
                 -- utilisation d'un parametre nommé :id pour se proteger des injection SQL (anti piratage) -- 
                 WHERE id_classe = :id
                 ";

        // Préparation de la requete SQL par PDO 
        $statement = $pdo->prepare($sql);

        // lien entre le parametre :id et la variable $id qui sont de type INT (:id récupère ses infos dans $id)
        $statement->bindParam(":id", $id, PDO::PARAM_INT);

        // Execution de la requete
        $statement->execute();

        // Récupération du resultat de la requete, sous forme d'un objet professeur grace à FETCH (ici)
        $statement->setFetchMode(PDO::FETCH_CLASS, 'Promo');
        $promos = $statement->fetch();

        // on va charger les informations du professeur principal selectionné grace à la  propriété id_professeur de mon objet Promo
        $prof_principal = Professeur::readOne ($promos->id_professeur);
        // enregistrons les informations du professeur principal dans la propriété prof_principal 
        $promos->prof_principal = $prof_principal;
        
        require_once("eleves.php");

        $eleves = Eleve::readAll($promos->id_classe);
        $promos->id_classe = $eleves;
        // return $promos;

        // on affiche le tableau associatif 
        // echo "<pre>";
        // var_dump($promos);
        // echo "</pre>";

        // pemet que la fonction readOne de retournes les informations et la listes des eleves de la classe (lien eleves.php = ligne 5)
        
    }
}
