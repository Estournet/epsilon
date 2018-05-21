<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 25/11/2017
 * Time: 10:43
 */
$module = 'connexion';
require_once(ROOT_DIR . "/module/mod_$module/modele_$module.php");
require_once(ROOT_DIR . "/module/mod_$module/vue_$module.php");
require_once(ROOT_DIR . "/module/mod_profil/mod_profil.php");

class ControleurConnexion extends ControleurGenerique {
	public function printConnexion() {
		if (isset($_POST["inputLogin"]) && isset($_POST["inputPassword"])) {
			$queryReturn = ModeleConnexion::connect(htmlspecialchars($_POST["inputLogin"]), htmlspecialchars($_POST["inputPassword"]));

			if ($queryReturn["success"] === true) {
				$_SESSION["idUser"] = $queryReturn["data"]["id_user"];
				$_SESSION["login"] = $queryReturn["data"]["login"];
				$this->constructView('VueConnexion', 'printConnexionSuccess', array($queryReturn));
			}
			else {
				$this->constructView('VueConnexion', 'printConnexion', array($queryReturn));
			}
		}
		else {
			$this->constructView('VueConnexion', 'printConnexion', array(array()));
		}

	}

	public function register() {
		if (isset($_POST["inputLogin"]) && isset($_POST["inputPassword"]) && isset($_POST["inputEmail"]) && isset($_POST["inputName"]) && isset($_POST["inputAddress"]) && isset($_POST["inputCity"])) {

			$queryReturn = ModeleConnexion::register(htmlspecialchars($_POST["inputLogin"]), htmlspecialchars($_POST["inputPassword"]), htmlspecialchars($_POST["inputEmail"]), htmlspecialchars($_POST["inputName"]), htmlspecialchars($_POST["inputAddress"]), htmlspecialchars($_POST["inputCity"]));
			if ($queryReturn["success"] === true) {
				$_SESSION["id_user"] = $queryReturn["data"]["id_user"];
				$_SESSION["login"] = $queryReturn["data"]["login"];
				header("Location: index.php?module=profil");
			}
			else
				$this->constructView('VueConnexion', 'printConnexion', array($queryReturn));

		}
		else {
			$this->constructView('VueConnexion', 'printConnexion', array(array()));
		}
	}

	public function disconnect() {
		session_destroy();
		$this->constructView('VueConnexion', 'printConnexion', array(array()));
	}
}
