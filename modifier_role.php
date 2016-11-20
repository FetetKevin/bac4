<?php


if(!empty($_POST['modifier']) && isset($_POST)){

    var_dump($_POST);

    $id_role = (int) $_POST['id_role'] ;
    $nom_role = (string) $_POST['nom_role'] ;


    $link = mysqli_connect('localhost','knab','knab','bac');

    $sql= "UPDATE roles SET  
	`nom_role` = '$nom_role'
	WHERE id_role  = $id_role";
    var_dump($sql);
    if(mysqli_query($link, $sql)){
        header("Location:formuAjoutRole.php?modif=ok");
    }
}

