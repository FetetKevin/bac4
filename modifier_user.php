<?php


if(!empty($_POST['modifier']) && isset($_POST)){

var_dump($_POST);

    $id_user = (int) $_POST['id_user'] ;
    $nom = (string) $_POST['nom'] ;
    $prenom = (string) $_POST['prenom'] ;
    $email = (string) $_POST['email'] ;
    $motDePasse = (string) $_POST['motDePasse'] ;
    $roles_id_role = (int) $_POST['roles_id_role'] ;

    $link = mysqli_connect('localhost','knab','knab','bac');

    $sql= "UPDATE users SET  
	`nom` = '$nom',
	`prenom` = '$prenom',
	`email` = '$email',
	`motDePasse` = '$motDePasse',
	`roles_id_role` = $roles_id_role
	WHERE id_user  = $id_user";
    var_dump($sql);
    if(mysqli_query($link, $sql)){
        header("Location:formuAjoutAdmin.php?modifok");
    }
}


