<?php

include("assets/inc/head.php");
// inclusion de la class Eleve 
require_once("models/promo.php");
// appel de la methode reaAll() de notre classe Eleve, qui nous permet de charger la liste de tous les eleves
$promos = Promo::readAll();
// echo "<pre>";
// var_dump($promos);
// echo "</pre>";
?>

<?php
include("assets/inc/head.php");
?>
<title>Promos</title>
<?php
include("assets/inc/header.php")
?>
<main class="ms-3">
    <h1>Promos</h1>
    <table class="table text-white">
        <tr>
            <th>Niveau</th>
            <th>Nom</th>
            <th>Nom P.P.</th>
            <th>Prenom P.P.</th>
            <th>Email</th>
            <th>Action</th>
        </tr>

        <!-- afficher les infos de chaque promo avec son professeur principal avec la boucle foreach -->
        <?php
        foreach ($promos as $promo) 
        {
            $promo->afficherInfos();
        }
        ?>
    </table>
</main>
<?php
include("assets/inc/footer.php")
?>