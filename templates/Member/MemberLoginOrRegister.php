<?php
namespace templates\Member;


?>
<header>
	<h3 class="alert alert-primary" role="alert">
		Connecte toi à cette chiasse, bouffon.
	</h3>
</header>
<form id="order_<?= $action ?>" method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
	<fieldset class="form-group">
	<label for="login">Login :</label><input id="login" name="login" class="form-control" type="text" required="required" value="<?= $data['login'] ?>" /> <br>
	<label for="login">Mot de passe :</label><input id="password" name="password" type="password" required="required" value="<?= $data['password'] ?>" /> <br>
	</fieldset>
	<input id="valide" name="create" class="btn btn-primary" type="submit" value="Valider" />
	<input id="passwordForgotten" name="create" class="btn btn-primary" type="submit" value="Mot de passe oublié" />
