<div class="container">
    <div class="panel panel-success" id="b1">
        <div class="panel-heading"><h3 class="text-center">Liste des Roles !</h3>
        </div>
        <div class="panel-body">


        <?php
//Connection Bdd
$link = mysqli_connect('localhost','knab','knab','bac');

//champ table
$tableHeading =array('id_role',
    'nom_role');
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
$roles = "SELECT  * FROM roles";
//send query
$reponse = mysqli_query($link, $roles);
echo "<tbody>";//tableau body debut

if(mysqli_num_rows($reponse)>0){//si il y a une reponse
    while($row = mysqli_fetch_assoc($reponse)){
        //debut formulaire
        echo '<form action="modifier_role.php" method="post">';


        echo "<tr class='".$row['id_role']."'>";//ouvre une ligne
        echo "<td class='".$row['id_role']."'>".$row['id_role']."<input type='hidden' name='id_role' value='".$row['id_role']."'></td>";
        echo "<td class='".$row['nom_role']."'>".$row['nom_role']."<input type='hidden' name='nom_role' value='".$row['nom_role']."'></td>";


        //Ici tu ajoute une icone supprimer dans la derniere cellule
        // onclick = fonction removeuser() pour supprimer et tu lui passe l'id de l'utilisateur a supprimer
        $champSupprimer = '<td><a id="'.$row["id_role"].'" href="javascript:void(0)" onclick="removeUser('.$row["id_role"].')"><span class="glyphicon glyphicon-remove"  style="color:red;" aria-hidden="true"></span></a></td>';
        echo $champSupprimer;

        $champModifier = ' <td><a  class="modifier" id="'.$row["id_role"].'" >
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
        <div class="panel-footer">Liste des <span style="color:green;">Roles</span></div>
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

    function removeUser( id_role ){
        $.ajax({
            url: 'supprimer_role.php',
            type: 'GET',
            data: 'id_role='+id_role,
            success: function(resultat){//si c'est ok
                $('#table').before(resultat);
            }
        })
    };

</script>