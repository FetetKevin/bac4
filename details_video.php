<?php
session_start();
include('config.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bac </title>
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

<!-- MENU -->
<?php include('navbar.php'); ?>
<br>
<br>


<section>
        <?php
        $sql ='SELECT * FROM videos WHERE id_video = '.$_GET["id_video"].' ';
        $reponse = mysqli_query($link,  $sql);
        while($row = mysqli_fetch_array($reponse)) {

            ?>
            <div class="container">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="text-center"><?= $row['titre_video']; ?></h3>
                    </div>
                    <div class="panel-body">
                        <p class="text-center">DATE : <?= $row['date_video']; ?></p>
                        <br>
                        <p class="text-center"><?= $row['desc_video']; ?></p>


                        <div class="panel-footer">
                                <center>
                                    <iframe width="600" height="400"
                                            src="https://www.youtube.com/embed/<?= $row['url_video']; ?>"
                                            frameborder="0" allowfullscreen style="margin-top:30px;"></iframe>
                                </center>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

        <br>
        <br>
        <div class="container">
            <div class="panel panel-danger">
                <div class="text-center panel-heading">COMMENTAIRES</div>
                    <div class="panel-body">
            <?php
             $sql ='SELECT * 
                    FROM commentaires 
                    INNER JOIN users
                    ON commentaires.commentaire_id_user = users.id_user
                    INNER JOIN roles 
                    ON roles.id_role = users.roles_id_role 
                    WHERE id_video = '.$_GET["id_video"].' 
                    ORDER BY date_commentaire';
            $reponse = mysqli_query($link,  $sql);
            while($row = mysqli_fetch_array($reponse)) {

                ?>

                    <div class="panel panel-info">
                        <div class="panel-heading">Posté par : <span style="color:black;font-weight: bold;"><?= strtoupper($row['nom']).' '. strtoupper($row['prenom']); ?></span> <?php if($row['nom_role'] == 'admin'){
                                                                                                                                                                    echo '[<span style="color:orange;">'.$row['nom_role'].'</span>]';
                                                                                                                                                                    }
                                                                                                                                                                    else {
                                                                                                                                                                        echo '(<span style="color:purple;">'.$row['nom_role'].'</span>)'; }?>  le <span style="color:red;"><?= $row['date_commentaire']; ?></span></div>
                        <div class="panel-body"><?= $row['desc_commentaire']; ?></div>
                    </div>

            <?php
            }
            ?>
            <hr>
                    </div>
                </div>
            </div>

        <?php
        if($_SESSION['logged']) {
            ?>
            <div class="container">
                <div class="panel panel-danger">
                    <div class="panel-heading"><h3 class="text-center">Ajoutez un Commentaire !</h3></div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="post" action="post_com.php?id_video=<?= $_GET['id_video'] ?>" id="formuLogin">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Votre commentaire</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" name="lienCom"></textarea>
                                </div>
                            </div>
<br>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input id="ajouter" name="ajouter" type="submit" value="Ajouter"
                                           class="btn btn-danger">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">Vous pouvez gerer vos commentaire [<a href="profil.php">ici</a>]</div>
                </div>
            </div>
            <?php
        }
        ?>
        <br>
    <?php include('remonter.php'); ?>

    <br>
    <br>
    </div>
</section>
<script src="custom.js"></script>
</body>
</html>