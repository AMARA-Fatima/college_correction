<?php
// declaration d'une class parent
class Personne
{
    public string $nom;
    public string $prenom;

    function direBonjour(): void
    {
        // pour les afficher avec echo
        echo "<p> Bonjour, je m'appelle " . $this->nom . " " . $this->prenom . "</p>";
    }
}
?>