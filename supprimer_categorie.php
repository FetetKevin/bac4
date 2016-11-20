<?php
//AJAX ***


//Connection Bdd
include('config.php');

if(isset($_GET['id_categorie'])&&!empty($_GET['id_categorie'])){

    $id_categorie = $_GET['id_categorie'];
}
$supprimer= "DELETE FROM categories WHERE id_categorie = $id_categorie";

if(mysqli_query($link,$supprimer)){

    $reponse= "ok c'est supprimé";
    echo $reponse;
}else{

    $reponse= "Erreur c'est pas supprimé";
    echo $reponse;
}

?>