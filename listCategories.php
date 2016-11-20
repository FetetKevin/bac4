<div class="container">
    <div class="row" id="d1">
        <div class="panel panel-success">
            <div class="panel-heading"><h3 class="text-center">Liste des Categories !</h3>
            </div>
            <div class="panel-body">


        <?php
//Connection Bdd
$link = mysqli_connect('localhost','knab','knab','bac');


$tableHeading =array('id_categorie',
    'nom_categorie');
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
$categories = "SELECT  * FROM categories";
//send query
$reponse = mysqli_query($link, $categories);
echo "<tbody>";//tableau body debut

if(mysqli_num_rows($reponse)>0){//si il y a une reponse
    while($row = mysqli_fetch_assoc($reponse)){
        //debut formulaire
        echo '<form action="modifier_categorie.php" method="post">';

        echo "<tr class='".$row['id_categorie']."'>";//ouvre une ligne
        echo "<td class='".$row['id_categorie']."'>".$row['id_categorie']."<input type='hidden' name='id_categorie' value='".$row['id_categorie']."'></td>";
        echo "<td class='".$row['nom_categorie']."'>".$row['nom_categorie']."<input type='hidden' name='nom_categorie' value='".$row['nom_categorie']."'></td>";


        //Ici tu ajoute une icone supprimer dans la derniere cellule
        // onclick = fonction removeuser() pour supprimer et tu lui passe l'id de l'utilisateur a supprimer
        $champSupprimer = '<td><a id="'.$row["id_categorie"].'" href="javascript:void(0)" onclick="removeUser('.$row["id_categorie"].')"><span class="glyphicon glyphicon-remove"  style="color:red;" aria-hidden="true"></span></a></td>';
        echo $champSupprimer;

        $champModifier = ' <td><a  class="modifier" id="'.$row["id_categorie"].'" >
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
            <div class="panel-footer">Liste des <span style="color:green;">Categories</span></div>
        </div>
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

    function removeUser( id_categorie ){
        $.ajax({
            url: 'supprimer_categorie.php',
            type: 'GET',
            data: 'id_categorie='+id_categorie,
            success: function(resultat){//si c'est ok
                $('#table').before(resultat);
            }
        })
    };

</script>