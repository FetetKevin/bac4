	<?php
	
	//Connection Bdd
    $link = mysqli_connect('localhost','knab','knab','bac');
	
	if(isset($_GET['id_user'])&&!empty($_GET['id_user'])){
		
		$id_user = $_GET['id_user'];
	}
	$supprimer= "DELETE FROM users WHERE id_user = $id_user";
	
	if(mysqli_query($link,$supprimer)){

		$reponse= "ok c'est supprimé";
		echo $reponse;
	}else{
		
		$reponse= "Erreur c'est pas supprimé";
		echo $reponse;
	}
	
	