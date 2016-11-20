<div class="container-fluid">
    <div class="panel panel-success" id="e1">
        <div class="panel-heading"><h3 class="text-center">Liste des Videos Postées !</h3></div>
        <div class="panel-body">
<?php
//Connection Bdd
$link = mysqli_connect('localhost','knab','knab','bac');

$tableHeading =array('id_video',
    'url_video',
    'vignette_video',
    'titre_video',
    'desc_video',
    'categorie_video',
    'date_video',
    'etat_video');
// Ajouter le champ supprimer dans l'entete du tableau
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


// PARTIE 2 (CE QUE CONTIENT LA BASE DE DONNEE)
echo "<tbody>";//tableau body debut

//On récupère tous les champs de la table users
$videos = "SELECT * FROM videos
	LEFT JOIN categories 
	ON videos.categorie_video = categories.id_categorie
	WHERE etat_video = 'publie'
	ORDER BY id_video";
//send query
$reponse = mysqli_query($link, $videos);
if(mysqli_num_rows($reponse)>0){
    //Ajout dans un tableau neuf pour lafficher avec la méthode tableBody
    while($row = mysqli_fetch_assoc($reponse)){


        echo '<form action="modifier_video.php" method="post">';

        echo "<tr class='".$row['id_video']."'>";//ouvre une ligne

        echo "<td class='".$row['id_video']."'>".$row['id_video']."<input type='hidden' name='id_video' value='".$row['id_video']."'></td>";
        echo "<td class='".$row['url_video']."'>".$row['url_video']."<input type='hidden' name='url_video' value='".$row['url_video']."'></td>";
        echo "<td class='".$row['vignette_video']."'>".$row['vignette_video']."<input type='hidden' name='vignette_video' value='".$row['vignette_video']."'></td>";
        echo "<td class='".$row['titre_video']."'>".$row['titre_video']."<input type='hidden' name='titre_video' value='".$row['titre_video']."'></td>";
        echo "<td class='".$row['desc_video']."'>".$row['desc_video']."<input type='hidden' name='desc_video' value='".$row['desc_video']."'></td>";
        echo "<td class='".$row['categorie_video']."'>".$row['categorie_video']."<input type='hidden' name='categorie_video' value='".$row['categorie_video']."'></td>";
        echo "<td class='".$row['date_video']."'>".$row['date_video']."<input type='hidden' name='date_video' value='".$row['date_video']."'></td>";
        echo "<td class='".$row['etat_video']."'>".$row['etat_video']."<select type='hidden' name='etat_video'>
                                                                            <option value='publie'>publie</option>
                                                                            <option value='non publie'>non publie</option>
                                                                      </select>      
                                                                         </td>";


        //Ici tu ajoute une icone supprimer dans la derniere cellule
        // onclick = fonction removeuser() pour supprimer et tu lui passe l'id de l'utilisateur a supprimer
        $champSupprimer = '<td><a id="'.$row["id_video"].'" href="javascript:void(0)" onclick="removeUser('.$row["id_video"].')">
						<span class="glyphicon glyphicon-remove"  style="color:red;" aria-hidden="true"></span></a></td>';
        echo $champSupprimer;

        $champModifier = ' <td><a  class="modifier" id="'.$row["id_video"].'" >
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
            <div class="panel-footer">Liste des <span style="color:green;">Videos Publiées</span></div>
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

    function removeUser( id_video ){
        $.ajax({
            url: 'supprimer_video.php',
            type: 'GET',
            data: 'id_video='+id_video,
            success: function(resultat){//si c'est ok
                $('#table').before(resultat);
            }
        })
    };

</script>