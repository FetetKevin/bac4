<?php


if(!empty($_POST['modifier']) && isset($_POST)){

    var_dump($_POST);

    $id_video = (int) $_POST['id_video'] ;
    $url_video = (string) $_POST['url_video'] ;
    $vignette_video = (string) $_POST['vignette_video'] ;
    $titre_video = (string) $_POST['titre_video'] ;
    $desc_video = (string) $_POST['desc_video'] ;
    $categorie_video = (string) $_POST['categorie_video'] ;
    $date_video =  (string) $_POST['date_video'];
    $etat_video =  (string) $_POST['etat_video'];


    $link = mysqli_connect('localhost','knab','knab','bac');

    $sql= "UPDATE videos SET  
	`id_video` = '$id_video',
	`url_video` = '$url_video',
	`vignette_video` = '$vignette_video',
	`titre_video` = '$titre_video',
	`desc_video` = '$desc_video',
	`categorie_video` = '$categorie_video',
	`date_video` = '$date_video',
	`etat_video` = '$etat_video'

	WHERE id_video  = $id_video";
    var_dump($sql);
    if(mysqli_query($link, $sql)){
        header("Location:formuAjoutVideo.php?modif=ok");
    }
    else {
        echo 'pas ok';
    }
}
