<?php
// inclusion de la class Eleve 
require_once("models/eleve.php");
// appel de la methode reaAll() de notre classe Eleve, qui nous permet de charger la liste de tous les eleves
$eleves = Eleve::readAll();
?>

<?php
include("assets/inc/head.php");
?>
<title>Eleves</title>
<?php
include("assets/inc/header.php")
?>
<main class="ms-3">
    <h1>Eleves</h1>
    <table class="table text-white">
        <tr>
            <th>Nom</th>
            <th>Prénon</th>
            <th>Date de naissance</th>
        </tr>
    <?php
    foreach($eleves as $eleve)
    {
        $eleve->afficherInfos();
    }
    ?>
    </table>
</main>
<?php
include("assets/inc/footer.php")
?>