<?php
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=first_form_verif;charset=utf8', 'root', 'stagiaire');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
?>