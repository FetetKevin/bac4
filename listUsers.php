<div class="container" style="margin-top: 30px;">
    <div class="panel panel-success" id="c1">
        <div class="panel-heading"><h3 class="text-center">Liste des Utilisateurs !</h3>
        </div>
        <div class="panel-body">



        <?php
//Connection Bdd
$link = mysqli_connect('localhost','knab','knab','bac');

// champs table
$tableHeading =array('id_user','nom',
    'prenom','email',
    'motDePasse','roles_id_role');
// ajout 2 champs
$tableHeading[]='supprimer';
$tableHeading[]='modifier';


echo "<table id='table' class='table table-bordered table-responsive table-hover'>";
//debut tableau head
echo "<thead><tr>";
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
$users = "SELECT  * FROM users order by id_user";
//send query
$reponse = mysqli_query($link, $users);

// PARTIE 2 (CE QUE CONTIENT LA BASE DE DONNEE)
echo "<tbody>";//tableau body debut

if(mysqli_num_rows($reponse)>0){//si il y a une reponse
    while($row = mysqli_fetch_assoc($reponse)){
        //debut formulaire
        echo '<form action="modifier_user.php" method="post">';

        echo "<tr class='".$row['id_user']."'>";//ouvre une ligne
        echo "<td class='".$row['id_user']."'>".$row['id_user']."<input type='hidden' name='id_user' value='".$row['id_user']."'></td>";
        echo "<td class='".$row['nom']."'>".$row['nom']."<input type='hidden' name='nom' value='".$row['nom']."'></td>";
        echo "<td class='".$row['prenom']."'>".$row['prenom']."<input type='hidden' name='prenom' value='".$row['prenom']."'></td>";
        echo "<td class='".$row['email']."'>".$row['email']."<input type='hidden' name='email' value='".$row['email']."'></td>";
        echo "<td class='".$row['motDePasse']."'>".$row['motDePasse']."<input type='hidden' name='motDePasse' value='".$row['motDePasse']."'></td>";
        echo "<td class='".$row['roles_id_role']."'>".$row['roles_id_role']."<input type='hidden' name='roles_id_role' value='".$row['roles_id_role']."'></td>";

        $champSupprimer = '<td><a class="supprimer" id="'.$row["id_user"].'" 
						href="javascript:void(0)" onclick="removeUser('.$row["id_user"].')">
						<span class="glyphicon glyphicon-remove"  style="color:red;" aria-hidden="true"></span></a>';

        echo $champSupprimer;

        $champModifier = ' <td><a  class="modifier" id="'.$row["id_user"].'" >
						<span class="glyphicon glyphicon-wrench" style="color:blue;" aria-hidden="true"></span></a>
						<input type="submit" name="modifier" value="modifier"></td>';
        echo $champModifier;

        echo "</tr>";//ferme la ligne
        echo '</form>';
    }
}
echo "</tbody>";//tableau body fin
echo "</table>";//FIN' DU TABLEAU
?>
        </div>
        <div class="panel-footer">Liste des <span style="color:green;">Utilisateurs</span></div>
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

    function removeUser( id_user ){
        $.ajax({
            url: 'supprimer_user.php',
            type: 'GET',
            data: 'id_user='+id_user,
            success: function(resultat){//si c'est ok
                $('#table').before(resultat);
            }
        })
    };

</script>
