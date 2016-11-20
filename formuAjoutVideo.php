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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <!-- CUSTOM STYLE CSS -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- ----- -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="http://orig04.deviantart.net/74de/f/2012/155/d/1/4chan_logo_hq_by_michaudotcom-d529rdh.png" type="image/x-icon" />
    <!-- JS : TRIER LES VIDEOS -->
    <script type="text/javascript" src="assets/js/tri_page_videos.js"></script>
    <script src="assets/js/placeholderTypewriter.js"></script>
</head>

<body>
<?php include ('navbar.php'); ?>
<?php include ('navbarAdmin.php'); ?>

<div class="container">
        <div class="panel panel-danger">
            <div class="panel-heading"><h3 class="text-center">Ajoutez une Video/Article !</h3>
            </div>
            <div class="panel-body">
            <form class="form-horizontal" role="form" method="post" action="traitementAjoutVideo.php">
                <div class="form-group">
                    <label class="col-sm-2 control-label">URL</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="lienUrl" id="url1" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Vignette</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="vignette" id="vignette" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">TITRE</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="lienTitre" id="titre1" value="">
                    </div>
                </div>

                <!-- SEPARATEUR -->
                <div class="row">
                    <div class="col-md-4 col-xs-12 col-md-offset-2" style="border-bottom: 1px solid darkgrey;box-shadow: 0px 2px 3px #888888;margin-bottom:30px;"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">DESCRIPTION</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" rows="4" name="description" id="description1" ></textarea>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <div class="col-md-6 col-md-offset-2">
                    <?php
                    $sql= "SELECT * FROM categories";
                    $req = $link->query($sql);

                    // on envoie la requête
                    while ($row = mysqli_fetch_object($req)) {
                        ?>
                        <label class="btn btn-danger checked">
                            <input type="radio" name="categorie[]" value="<?= $row->id_categorie;?>"> <?= $row->nom_categorie;?>
                        </label>
                        <?php
                    }
                    ?>
                    <br>
                    <br>
                    <label class="btn btn-danger checked">
                        <input type="radio" name="etat" value="publie"> Publie
                    </label>
                    <label class="btn btn-danger">
                        <input type="radio" name="etat" value="non publie"> Non Publie
                    </label>
                </div>

                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <input name="envoyer" type="submit" value="Ajouter une video" class="btn btn-danger" style="margin-top:30px;">
                    </div>
                </div>
                <br>
                <br>
                <br>
            </form>
        </div>
    </div>
</div>
<br>
<br>
<br>
<center><button id="e" class="btn btn-success" style="margin-bottom: 20px;"><i class="glyphicon glyphicon-envelope"> Gerer les videos postées !</i></button></center>

<?php include('listVideos.php'); ?>

<center><button id="f" class="btn btn-warning" style="margin-bottom: 20px;"><i class="glyphicon glyphicon-envelope"> Gerer les videos en attentes !</i></button></center>

<?php include('listVideos2.php'); ?>
<?php include('remonter.php'); ?>

<script src="dynamicplaceholder.js"></script>
<script src="custom.js"></script>
<script type="text/javascript">
    $("#e1").hide();
    $("#e").click(function() {
        $( "#e1" ).toggle(1000);
    });

    $("#f1").hide();
    $("#f").click(function() {
        $( "#f1" ).toggle(1000);
    });

</script>

</body>
</html>