<?php
include('config.php');
if($_SESSION['logged'] && $_SESSION['nom_role'] == "admin") {
}
else {
    header('Location: index.php?notadmin');
}

if(!empty($_POST['modifier']) && isset($_POST)){

    $id_commentaire = (int) $_POST['id_commentaire'];
    $desc_commentaire = (string) $_POST['desc_commentaire'] ;


    $sql= "UPDATE commentaires SET  
	`desc_commentaire` = '$desc_commentaire'
	WHERE id_commentaire  = $id_commentaire";

    if(mysqli_query($link, $sql)){
        header("Location:listCommentairesAdmin.php?ok");
    }
}