<?php
// inclusion de la class Eleve 
require_once("models/professeur.php");
// appel de la methode reaAll() de notre classe Eleve, qui nous permet de charger la liste de tous les eleves
$professeurs = Professeur::readAll();
?>

<?php
include("assets/inc/head.php");
?>
<title>Professeurs</title>
<?php
include("assets/inc/header.php")
?>
<main class="ms-3">
    <h1>Professeurs</h1>
    <!-- todo: afficher la liste de tous les professeurs, en utilisant un fichiser models/professeur.php contenant une classe professeur (comme on afait pour les eleves) -->
    <table class="table text-white">
        <tr>
            <th>Nom</th>
            <th>Prénon</th>
            <th>Email</th>
        </tr>
    <?php
    foreach($professeurs as $professeur)
    {
        $professeur->afficherInfos();
    }
    ?>
    </table>
</main>
<?php
include("assets/inc/footer.php")
?>