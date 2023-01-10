<?php
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
            <th>Nom</th>
            <th>Niveau</th>
            <th>Id_classe</th>
            <th>Id_professeur</th>
            <th>Prof_principal</th>
        </tr>
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