<?php
session_start();
include('config.php');
if($_SESSION['logged'] && $_SESSION['nom_role'] == "admin") {
}
else {
    header('Location: index.php?notadmin');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bac</title>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <!-- CUSTOM STYLE CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- ----- -->
    <link rel="shortcut icon" href="http://orig04.deviantart.net/74de/f/2012/155/d/1/4chan_logo_hq_by_michaudotcom-d529rdh.png" type="image/x-icon" />
    <!-- JS : TRIER LES VIDEOS -->
    <script type="text/javascript" src="assets/js/tri_page_videos.js"></script>
    <script src="assets/js/placeholderTypewriter.js"></script>
</head>

<body>
<?php include ('navbar.php'); ?>
<?php include ('navbarAdmin.php'); ?>

<div class="container">
    <div class="panel panel-danger" style="margin-top: 30px;">
        <div class="panel-heading"><h3 class="text-center">Ajoutez un Utilisateur !</h3></div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="post" action="traitementAjoutAdmin.php" id="formuLogin">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Nom</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="lienNom" id="nom" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstname" class="col-sm-2 control-label">Prénom</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="lienPrenom" id="prenom" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="lienEmail" id="email" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Mot de passe</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="lienMotDePasse" id="mdp" value="">
                    </div>
                </div>
                <div class="col-md-6 col-md-offset-2">
                    <?php
                    $sql= "SELECT * FROM roles";
                    $req = $link->query($sql);

                    // on envoie la requête
                    while ($row = mysqli_fetch_object($req)) {
                        ?>
                        <label class="btn btn-danger checked">
                            <input type="radio" name="role[]" value="<?= $row->id_role;?>"> <?= $row->nom_role;?>
                        </label>
                        <?php
                    }
                    ?>
                </div>
                <br>
                <br>
                <br>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <input id="ajouter" name="ajouter" type="submit" value="S'enregistrer" class="btn btn-danger">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<center><button id="c" class="btn btn-success" style="margin-bottom: 20px;"><i class="glyphicon glyphicon-envelope"> Gerer les users !</i></button></center>

<?php include('listUsers.php'); ?>
<script src="dynamicplaceholder.js"></script>
<script src="custom.js"></script>
<script type="text/javascript">
    $("#c1").hide();
    $("#c").click(function() {
        $( "#c1" ).toggle(1000);
    });

</script>
</body>
</html>
