<!-- FONCTION SERVANT A AJOUTER UNE NOUVELLE VIDEO DANS LA BDD --><!-- FONCTION SERVANT A AJOUTER UNE NOUVELLE VIDEO DANS LA BDD --><!-- FONCTION SERVANT A AJOUTER UNE NOUVELLE VIDEO DANS LA BDD -->
<?php

include('config.php');


if (!empty($_POST) && isset($_POST['lienUrl']) && isset($_POST['vignette']) && isset($_POST['lienTitre']) && isset($_POST['description'])) {
    $lienUrl = htmlspecialchars($_POST['lienUrl']);
    $vignette = htmlspecialchars($_POST['vignette']);
    $lienTitre = htmlspecialchars($_POST['lienTitre']);
    $description = htmlspecialchars($_POST['description']);
    $publie = $_POST['etat'];

    foreach ($_POST['categorie'] as $valeur) {
        $req = 'INSERT INTO `videos`(`url_video`,`vignette_video`, `titre_video`, `date_video`, `desc_video`, `categorie_video`, `etat_video`) VALUES ("' . $lienUrl . '","' . $vignette . '","' . $lienTitre . '",  NOW()  ,"' . $description . '","' . $valeur . '","'.$publie.'")';

    }
    if (!$_POST['categorie']) {
        echo "Aucune checkbox n'a été cochée";
    }



}

if (mysqli_query($link, $req)) {
    echo '<center><p class=\'text-danger\'>ALED</p></center>';
   header('Location: index.php?videoajoutee');
} else {
    echo "Error: " . $req . "<br>" . mysqli_error($link);
   header('Location: index.php?rip');
}


mysqli_close($link);

?>
<!-- FONCTION SERVANT A AJOUTER UNE NOUVELLE VIDEO DANS LA BDD --><!-- FONCTION SERVANT A AJOUTER UNE NOUVELLE VIDEO DANS LA BDD --><!-- FONCTION SERVANT A AJOUTER UNE NOUVELLE VIDEO DANS LA BDD -->
