<?php
namespace templates\Member;


?>
<header>
	<h3 class="alert alert-primary" role="alert">
		Connecte toi � cette chiasse, bouffon.
	</h3>
</header>
<form id="order_<?= $action ?>" method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
	<fieldset class="form-group">
	<label for="login">Login :</label><input id="login" name="login" class="form-control" type="email" required="required"  /> <br>
	<label for="password">Mot de passe :</label><input id="password" name="password" type="password" required="required"  /> <br>
	</fieldset>
	<input id="valide" name="create" class="btn btn-primary" type="submit" value="Valider" />
	<input id="passwordForgotten" name="create" class="btn btn-primary" type="submit" value="Mot de passe oubli�" />
	<input id="register" name="register" class="btn btn-primary" type="submit" value="S'inscrire" />
</form>

<?php 
if(!empty($_POST)){
    if(empty($_POST['login']))
    {
        $message = 'Veuillez indiquer votre login svp !';
    }
    elseif(empty($_POST['password']))
    {
        $message = 'Veuillez indiquer votre mot de passe svp !';
    }
}



?>