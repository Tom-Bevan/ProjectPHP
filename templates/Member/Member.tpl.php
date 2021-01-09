<?php
namespace mvcCore\Views\Templates;

use mvcCore\Data\Cars;

?>
	<fieldset class="form-group">
		<legend>Informations personnelles : </legend>
		<label for="lastname">Nom :</label><input id="lastname" name="lastname" class="form-control" type="text" required="required" value="<?= $data['lastname'] ?>" /> 
		<label for="firstname">Prénom:</label><input id="firstname" name="firstname" class="form-control" type="text" required="required" value="<?= $data['firstname'] ?>" />
		<label for="email">Email :</label><input id="email" name="email" class="form-control" type="email" required="required" value="<?= $data['email'] ?>"/>
		<label for="birthday">Date de naissance :</label><input id="birthday" name="birthday" class="form-control" type="date" required="required" value="<?= $data['birthday'] ?>"/>
		
		</fieldset>
		<fieldset class="form-group">
				<label for="pdp">Photo de profile :</label><input id="birthday" name="birthday" class="form-control" type="date" required="required" value="<?= $data['birthday'] ?>"/>
				</fieldset>
			<input id="create" name="create" class="btn btn-primary" type="submit" value="Valider" />