<?php
namespace mvcCore\Views\Templates;


?>
	<header>
		<h3 class="alert alert-primary" role="alert">
			Maintenant crÃ©e ton compte, bouffon.
		</h3>
	</header>
	<div class="alert alert-danger" role="alert">Les champs en rouge sont obligatoires !</div>
	</header>
	<form id="register_<?= $action ?>" method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
	<fieldset class="form-group">
		<legend>Informations personnelles : </legend>
		<label for="lastname">Nom :</label><input id="lastname" name="lastname" class="form-control" type="text" required="required" value="<?= $data['lastname'] ?>" /> <br>
		<label for="firstname">PrÃ©nom:</label><input id="firstname" name="firstname" class="form-control" type="text" required="required" value="<?= $data['firstname'] ?>" /><br>
		<label for="email">Email :</label><input id="email" name="email" class="form-control" type="email" required="required" value="<?= $data['email'] ?>"/><br>
		<label for="birthday">Date de naissance :</label><input id="birthday" name="birthday" class="form-control" type="date" required="required" value="<?= $data['birthday'] ?>"/><br>
		
		</fieldset>
		<fieldset class="form-group">
		<form action="upload_pdp.php" method="post" enctype="mulHpart/form-data”>	
				<label for="pdp">Photo de profile :</label>
				<input id="pdp" name="pdp" type="file" required="required" />
				</fieldset>
				</form>	
		<fieldset class="form-group">
			<legend>Identifiant de connexion: </legend>
			<label for="login1">Login :</label><input id="login1" name="login1" class="form-control" type="email" required="required" value="<?= $data['login1'] ?>" /> <br>
			<label for="login2">Mail de récupération de login :</label><input id="login2" name="login2" class="form-control" type="email" required="required" value="<?= $data['login2'] ?>" /> <br>
			<label for="password1">Mot de passe :</label><input id="password1" name="password1" type="password" required="required" value="<?= $data['password1'] ?>" /> <br>
			<label for="password2">Mot de passe à nouveau :</label><input id="password2" name="password2" type="password" required="required" value="<?= $data['password2'] ?>" /> <br>
			</fieldset>
			<input id="create" name="create" class="btn btn-primary" type="submit" value="Valider" />
			
		<?php
// 		if(!isset($_FILES["file"])){
// 		if	(((	($_FILES["file"]["type"]=="image/jpeg")||($_FILES["file"]["type"]=="image/pjpeg"))&&($_FILES["file"]["size"]<20000))){	
// 			if($_FILES["file"]["error"]	>	0){	
//         	 	echo	"Erreur:".$_FILES["file"]["error"]."<br/>";	
//             }	
//              else{	
//         	 	echo	"Image validée";
//         	}	
// }	
//         else	{	
// 	 	     echo	"Fichier invalide"; 
//         }	
// 	}
        ?>	