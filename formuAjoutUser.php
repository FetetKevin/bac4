<?php
session_start();
include('config.php');
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
    <script src="assets/js/placeholderTypewriter.js"></script>
</head>

<body>

<?php include('navbar.php'); ?>


<div class="container">
<div class="panel panel-danger">
    <div class="panel-heading"><h3 class="text-center">Inscrivez-vous !</h3>
    </div>
    <div class="panel-body">
            <form class="form-horizontal" role="form" method="post" action="traitementAjoutUser.php" id="formuLogin">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Nom</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="lienNom" id="nom2" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstname" class="col-sm-2 control-label">Prénom</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="lienPrenom" id="prenom2" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="lienEmail" id="email2" value="<?php //echo htmlspecialchars($_POST['email']); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Mot de passe</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="lienMotDePasse" id="mdp2" value="<?php //echo htmlspecialchars($_POST['nom']); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <input id="ajouter" name="ajouter" type="submit" value="S'enregistrer" class="btn btn-danger">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="dynamicplaceholder.js"></script>

</body>
</html>