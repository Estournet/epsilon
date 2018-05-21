<?php

/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 25/11/2017
 * Time: 10:43
 */
class ModuleConnexion extends ModuleGenerique {
	public function __construct() {
		$module = "connexion";
		require_once "module/mod_$module/controleur_$module.php";

		if (isset($_GET["action"]))
			$action = $_GET["action"];
		else
			$action = null;

		switch ($action) {
			case "inscription" :
				$this->controleur = new Controleurconnexion ();
				$this->controleur->register();
				break;
			case "connexion" :
				$this->controleur = new Controleurconnexion ();
				$this->controleur->printConnexion();
				break;
			case "deconnexion" :
				$this->controleur = new Controleurconnexion ();
				$this->controleur->disconnect();
				break;
			default :
				$this->controleur = new ControleurConnexion();
				$this->controleur->printConnexion();
		}
	}
}