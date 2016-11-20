<?php
include('config.php');

if(!empty($_POST['modifier']) && isset($_POST)) {


    $id_categorie = (int)$_POST['id_categorie'];
    $nom_categorie = (string)$_POST['nom_categorie'];


    $sql = "UPDATE `categories` 
            SET `nom_categorie` = '$nom_categorie' 
            WHERE `categories`.`id_categorie` = $id_categorie";
}
    if(mysqli_query($link, $sql)){
        header("Location:formuAjoutCategorie.php?oui");
    }

