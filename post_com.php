<?php
session_start();
include('config.php');

if (!empty($_POST) && isset($_POST['lienCom'])) {
    $lienCom = htmlspecialchars($_POST['lienCom']);
    $video = $_GET['id_video'];
    $user = $_SESSION['id_user'];


    $req = "INSERT INTO `commentaires`(`id_video`,`commentaire_id_user`,`desc_commentaire`,`date_commentaire`) VALUES ('".$video."','".$user."','" . $lienCom . "', NOW())";


}



if (mysqli_query($link, $req)) {
    echo '<center><p class=\'text-danger\'>Ajout effectué :)</p></center>';
    header('Location:details_video.php?id_video='.$_GET['id_video']);
} else {
    echo "Error: " . $req . "<br>" . mysqli_error($link);
   //header('Location: index.php');
}

mysqli_close($link);



