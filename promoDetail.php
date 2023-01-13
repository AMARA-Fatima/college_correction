<?php
include("assets/inc/head.php");
?>
<title>Detail Promo</title>
<?php
include("assets/inc/header.php")
?>
<main class="ms-3">
    <h1>Detail Promo</h1>
    <table class="table text-white">
        <?php
        /* todo: 
    - afficher les informations d'une promotion en fonction de son ID.

        indice : $_GET[] (parametre en URL)
        indice : creer une méthode readOne() dans la classe Promo

    - afficher les informations de tous les eleves de cette promo sous forme de tableau .
    */
        require_once("models/promo.php");

        echo $_GET["id"];

        $promo = Promo::readOne($_GET["id"])

        ?>
        <tr>
            <th>Niveau</th>
            <th>Nom</th>
            <th>Nom P.P.</th>
            <th>Prenom P.P.</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <!-- <tr>
            <td>Nom</td>
            <td>Prenom</td>
            <td>date_naissance</td>
        </tr> -->
        <!-- afficher les infos de chaque promo avec son professeur principal avec la boucle foreach -->
        <?php
        $promo->afficherInfos();
        ?>
    </table>
</main>
<?php
include("assets/inc/footer.php")
?>