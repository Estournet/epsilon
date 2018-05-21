<?php

class ModuleAccueil extends ModuleGenerique {
	public function __construct() {
		$module = "accueil";
		require_once ROOT_DIR . "/module/mod_$module/controleur_$module.php";
		$this->controleur = new ControleurAccueil();
		$this->controleur->printHomepage();
	}
}