<?php

//Connection Bdd
$link = mysqli_connect('localhost','knab','knab','bac');

if(isset($_GET['id_commentaire'])&&!empty($_GET['id_commentaire'])){

    $id_commentaire = $_GET['id_commentaire'];
}
$supprimer= "DELETE FROM commentaires WHERE id_commentaire = $id_commentaire";

if(mysqli_query($link,$supprimer)){

    $reponse= "ok c'est supprimé";
    echo $reponse;
}else{

    $reponse= "Erreur c'est pas supprimé";
    echo $reponse;
}
	
	