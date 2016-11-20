<?php
session_start();
//Connection Bdd
$link = mysqli_connect('localhost','knab','knab','bac');

if(isset($_GET['id_user'])&&!empty($_GET['id_user'])) {

    $id_user = $_GET['id_user'];
    var_dump($id_user);
}

    $supprimer = 'DELETE FROM users WHERE id_user =  '.$_SESSION["id_user"].'';


if(mysqli_query($link,$supprimer)){
    session_unset();
    session_destroy();
    header('Location:index.php?memberdelete');
}else{
    $reponse= "Erreur c'est pas supprimé";
    echo $reponse;
}
