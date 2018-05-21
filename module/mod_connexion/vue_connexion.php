<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 25/11/2017
 * Time: 10:43
 */

class VueConnexion {
	public static function printConnexion(array $databaseReturn) {
		if (isset($databaseReturn["success"]) && !$databaseReturn["success"])
			echo ' 
				<div class="alert alert-danger alert-dismissable">
			 		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				 	<strong>Erreur !</strong> ' . $databaseReturn["message"] . '
				</div>';


		echo('
			<div class="container">
				<form class="form-signin" id="connexion_form" action="index.php?module=connexion&action=connexion" method="post">
					<h2 class="form-signin-heading">Connexion</h2>
					<label for="inputLogin" class="sr-only">Login</label>
					<input type="text" name="inputLogin" id="inputLogin" class="form-control form-signin-top" placeholder="Login" required autofocus>
					
					<label for="inputPassword" class="sr-only">Mot de passe</label>
					<input type="password" name="inputPassword" id="inputPassword" class="form-control form-signin-bottom" placeholder="Mot de passe" required>
					
					<button class="btn btn-lg btn-success btn-block" type="submit">Connexion</button>
					<a class="btn btn-lg btn-outline-primary btn-block" id="inscription_link" href="#" role="button">Inscrivez vous</a>
				</form>
				<form class="form-signin" id="inscription_form" action="index.php?module=connexion&action=inscription" method="post" style="display: none;">
					<h2 class="form-signin-heading">Inscription</h2>
					<label for="inputLogin" class="sr-only">Login</label>
					<input type="text" name="inputLogin" id="inputLogin" class="form-control form-signin-top" placeholder="Login" required autofocus>

					<label for="inputEmail" class="sr-only">Adresse Email</label>
					<input type="email" name="inputEmail" id="inputEmail" class="form-control form-signin-middle" placeholder="Adresse Email" required>
					
					<label for="inputPassword" class="sr-only">Mot de passe</label>
					<input type="password" name="inputPassword" id="inputPassword" class="form-control form-signin-middle" placeholder="Mot de passe" required>					

					<label for="inputName" class="sr-only">Prénom et nom</label>
					<input type="text" name="inputName" id="inputName" class="form-control form-signin-middle" placeholder="Prénom et nom" required>

					<label for="inputAddress" class="sr-only">Adresse</label>
					<input type="text" name="inputAddress" id="inputAddress" class="form-control form-signin-middle" placeholder="Adresse" required>

					<label for="inputCity" class="sr-only">Ville</label>
					<input type="text" name="inputCity" id="inputCity" class="form-control form-signin-bottom" placeholder="Ville" required>

					<button class="btn btn-lg btn-success btn-block" type="submit">S\'inscrire</button>
					<a class="btn btn-lg btn-outline-primary btn-block" id="connexion_link" href="#" role="button">J\'ai déjà un compte</a>
				</form>
			</div>    	
	');
	}

	public static function printConnexionSuccess(){
		echo('
		<div class="alert alert-success">
			<strong>Succès !</strong> Vous vous êtes connecté avec succès.
		</div>
		');
	}
}