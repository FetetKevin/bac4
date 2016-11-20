<?php

//Connection Bdd
include('config.php');

if(isset($_GET['id_video'])&&!empty($_GET['id_video'])){

    $id_video = $_GET['id_video'];
}
$supprimer= "DELETE FROM videos WHERE id_video = $id_video";

if(mysqli_query($link,$supprimer)){

    $reponse= "ok c'est supprimé";
    echo $reponse;
}else{

    $reponse= "Erreur c'est pas supprimé";
    echo $reponse;
}

