<?php
session_start();
include('config.php');
if($_SESSION['logged']){
}
else {
    header('Location:index.php?notconnected');
}
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
    <!--afficher l'heure en direct-->
    <script type="text/javascript">
        function date_heure(id)
        {
            date = new Date;
            annee = date.getFullYear();
            moi = date.getMonth();
            mois = new Array('Janvier','F&eacute;vrier','Mars','Avril','Mai','Juin','Juillet','Ao&ucirc;t','Septembre','Octobre','Novembre','D&eacute;cembre');
            j = date.getDate();
            jour = date.getDay();
            jours = new Array('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi');
            h = date.getHours();
            if(h<10)
            {
                h = "0"+h;
            }
            m = date.getMinutes();
            if(m<10)
            {
                m = "0"+m;
            }
            s = date.getSeconds();
            if(s<10)
            {
                s = "0"+s;
            }
            resultat = jours[jour]+' '+j+' '+mois[moi]+' '+annee+' '+h+':'+m+':'+s;
            document.getElementById(id).innerHTML = resultat;
            setTimeout('date_heure("'+id+'");','1000');
            return true;
        }
    </script>


</head>

<body>
<?php include('navbar.php'); ?>
<h1>Bienvenu sur votre page de profil <?= $_SESSION["nom"].' '.$_SESSION['prenom']; ?>!</h1>

<?php
//Connection Bdd
$link = mysqli_connect('localhost','knab','knab','bac');


$tableHeading =array('id_user','nom',
    'prenom','email',
    'motDePasse',
    'roles_id_role');
// Ajouter le champ supprimer dans l'entete du tableau
$tableHeading[]='supprimer';
$tableHeading[]='modifier';
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 ">
            <div style="background-color:whitesmoke;text-align: center;height:30px;border: 2px solid grey;">
                <p class=" text-info" id="date_heure" style="color:red;font-weight:bold;font-size: 24px;">
                    <script type="text/javascript">window.onload = date_heure('date_heure');</script>
                </p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >

            <?php
            //On récupère tous les champs de la table users
            $users = 'SELECT * FROM users WHERE id_user = '.$_SESSION["id_user"].'';
            //send query
            $reponse = mysqli_query($link, $users);


            if(mysqli_num_rows($reponse)>0){//si il y a une reponse
            while ($row = mysqli_fetch_assoc($reponse)) {
            ?>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="text-center"><?= strtoupper($row["nom"]).' '.strtoupper($row['prenom']); ?></h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center">
                            <img alt="User Pic" src="uploads/<?= $row['avatar_user']; ?>"
                                 class="img-squarre img-responsive">
                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                Select image to upload:
                                <input type="file" name="fileToUpload" id="fileToUpload">
                                <input type="submit" value="Upload Image" name="submit">
                            </form>
                        </div>
                        <div class=" col-md-12 col-lg-12 ">
                            <table class="table table-user-information">
                                <tbody>
                                <?php
                                //debut formulaire
                                echo '<form action="modifier_user_profil.php" method="post">';

                                ?>
                                <tr>
                                    <td><span>Infos :</span></td>
                                    <td></td>
                                </tr>
                                <tr class="<?php $row['id_user']; ?>">
                                <tr class="<?php $row['id_user']; ?>">
                                    <td>ID:</td>
                                    <td><?= $row['id_user']; ?></td>
                                    <td><input class='modifier' type='hidden' name='id_user'
                                               value="<?= $row['id_user']; ?>"></td>
                                </tr>
                                <tr class="<?php $row['nom']; ?>">
                                    <td>nom:</td>
                                    <td><?= $row['nom']; ?></td>
                                    <td><input class='modifier' type='hidden' name='nom'
                                               value="<?= $row['nom']; ?>"></td>
                                </tr>
                                <tr class="<?php $row['prenom']; ?>">
                                    <td>prenom:</td>
                                    <td><?= $row['prenom']; ?></td>
                                    <td><input class='modifier' type='hidden' name='prenom'
                                               value="<?= $row['prenom']; ?>"></td>
                                </tr>
                                <tr class="<?php $row['email']; ?>">
                                    <td>email:</td>
                                    <td><?= $row['email']; ?></td>
                                    <td><input class='modifier' type='hidden' name='email'
                                               value="<?= $row['email']; ?>"></td>
                                </tr>
                                <tr class="<?php $row['motDePasse']; ?>">
                                    <td>motDePasse:</td>
                                    <td><?= $row['motDePasse']; ?></td>
                                    <td><input class='modifier' type='hidden' name='motDePasse'
                                               value="<?= $row['motDePasse']; ?>"></td>
                                </tr>
                                <tr class="<?php $row['avatar_user']; ?>">
                                    <td>Avatar :</td>
                                    <td><?= $row["avatar_user"]; ?></td>
                                    <td><input class='modifier' type='hidden' name='avatar_user'
                                               value="<?= $row['avatar_user']; ?>"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><span>Actions :</span></td>
                                </tr>
                                <?php
                                echo '<tr>';
                                echo '<td>Delete</td>';
                                echo '<td>Modifier</td>';
                                echo '</tr>';
                                $champSupprimer = '<td><a class="supprimer" id="' . $row["id_user"] . '"
                                    href="supprimer_user_profil.php?id_user=' . $row["id_user"] . '" onclick="removeUser(' . $row["id_user"] . ')">
                                    <span class="glyphicon glyphicon-remove"  style="color:red;" aria-hidden="true"></span></a>';

                                echo $champSupprimer;

                                $champModifier = ' <td><a  class="modifier" id="' . $row["id_user"] . '" >
                                    <span class="glyphicon glyphicon-wrench" style="color:blue;" aria-hidden="true"></span></a>
                                    <input type="submit" name="modifier" value="modifier"></td>';
                                echo $champModifier;

                                echo "</tr>";//ferme la ligne
                                echo '</form>';
                                ?>
                                </tbody>
                                <?php
                                }
                                }
                            ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <center><button id="a" class="btn btn-success"><i class="glyphicon glyphicon-envelope"> Mes messages!</i></button></center>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('listCommentairesProfil.php'); ?>

<?php include('remonter.php'); ?>

<script type="text/javascript">
    $("#a1").hide();
    $("#a").click(function() {
        $( "#a1" ).toggle(1000);
    });

    $(document).ready(function(){

        $(':submit[name=modifier]').hide();

        //click sur modifier
        var $elems = $(':input[name=modifier]');
        var $spans = $('.modifier');

        $spans.on('click',function()
        {
            var $elem = $(this);
            var $elem_class = $elem.attr('class');
            var $tr = $elem.parent().parent();
            var $tr_class = $tr.attr('class');

            $inputs = $tr.find(':hidden');
            $spans.each(function(){
                $(this).attr('type','text');

            });
            $inputs.last().show().attr('type','submit');


        });

    });
    //JQUERY


</script>
<script src="custom.js"></script>


</body>
</html>