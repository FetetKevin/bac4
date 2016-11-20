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

</head>

<body>
<?php include('navbar.php'); ?>
<br>
<br>
<?php include('navbarAdmin.php'); ?>
<div class="container">
    <div class="panel panel-success">
        <div class="panel-heading"><h3 class="text-center">Liste des Commentaires !</h3>
        </div>
        <div class="panel-body">
<?php
//Connection Bdd
include('config.php');
//champ table
$tableHeading =array('id_commentaire',
    'user_name',
    'role',
    'titre_video',
    'desc_commentaire');
// Ajouter le champ supprimer/modifier dans l'entete du tableau
$tableHeading[]='supprimer';
$tableHeading[]='modifier';


// PARTIE 1 ( LE HEADER DU TABLEAU)
//DEBUT DU TABLEAU
echo "<table id='table' class='table table-bordered table-responsive table-hover'>";
echo "<thead><tr>";	//debut tableau head
//Ici on affiche les champs du tableau : entete
$i=0;
$tailleChamps = count($tableHeading);
//boucle sur le tableau qui contient les noms des champs
for( $i; $i < $tailleChamps; $i++)
{  ?>
    <!-- pour chaque champs afficher -->
    <th><?=$tableHeading[$i]?></th>
<?php }
echo "</tr></thead>";	//fin tableau head




//On récupère tous les champs de la table users
$roles = 'SELECT * FROM commentaires 
            INNER JOIN videos 
            ON commentaires.id_video = videos.id_video 
            INNER JOIN users 
            ON commentaires.commentaire_id_user = users.id_user 
            INNER JOIN roles 
            ON roles.id_role = users.roles_id_role ';
//send query
$reponse = mysqli_query($link, $roles);
echo "<tbody>";//tableau body debut

if(mysqli_num_rows($reponse)>0){//si il y a une reponse
    while($row = mysqli_fetch_assoc($reponse)){
        //debut formulaire
        echo '<form action="modifierCommentairesAdmin.php" method="post">';

        echo "<tr class='".$row['id_commentaire']."'>";//ouvre une ligne
        echo "<td class='".$row['id_commentaire']."'>".$row['id_commentaire']."<input type='hidden' name='id_commentaire' value='".$row['id_commentaire']."'></td>";;
        echo "<td class='".$row['nom']."'>".$row['nom'].' '.$row['prenom'];
        if($row['nom_role'] == 'admin'){
            echo '<td class='.$row['nom_role'].'>[<span style="color:orange;">'.$row['nom_role'].'</span>]';
        }
        else {
            echo '<td class='.$row['nom_role'].'>(<span style="color:purple;">'.$row['nom_role'].'</span>)';
        };
        echo "<td class='".$row['titre_video']."'>".$row['titre_video'];
        echo "<td class='".$row['desc_commentaire']."'>".$row['desc_commentaire']."<input type='hidden' name='desc_commentaire' value='".$row['desc_commentaire']."'></td>";


        //Ici tu ajoute une icone supprimer dans la derniere cellule
        // onclick = fonction removeuser() pour supprimer et tu lui passe l'id de l'utilisateur a supprimer
        $champSupprimer = '<td><a id="'.$row["id_commentaire"].'" href="javascript:void(0)" onclick="removeUser('.$row["id_commentaire"].')"><span class="glyphicon glyphicon-remove" style="color:red;" aria-hidden="true"></span></a></td>';
        echo $champSupprimer;

        $champModifier = ' <td><a  class="modifier" id="'.$row["id_commentaire"].'" >
						<span class="glyphicon glyphicon-wrench" style="color:blue;" aria-hidden="true"></span></a>
						<input type="submit" name="modifier" value="modifier"></td>';
        echo $champModifier;

        echo "</tr>";//ferme la ligne
        echo '</form>';
    }
}

echo "</tbody>";//tableau body fin
echo "</table>";//FIN DU TABLEAU
?>

        </div>
        <div class="panel-footer">Liste des <span style="color:green;">Commentaires du Site</span></div>
    </div>
</div>



<script type="text/javascript">


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
            $inputs.each(function(){
                $(this).attr('type','text');

            });
            $inputs.last().show().attr('type','submit');


        });

    });
    //JQUERY








    var id_user=null;

    function removeUser( id_commentaire ){
        $.ajax({
            url: 'supprimer_commentaire_profil.php',
            type: 'GET',
            data: 'id_commentaire='+id_commentaire,
            success: function(resultat){//si c'est ok
                $('#table').before(resultat);
            }
        })
    };

</script>