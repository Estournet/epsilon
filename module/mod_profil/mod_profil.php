<?php

/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 25/11/2017
 * Time: 18:58
 */
class ModuleProfil extends ModuleGenerique {
	public function __construct() {
		$module = "profil";
		require_once "module/mod_$module/controleur_$module.php";


		$this->controleur = new ControleurProfil ();
		$this->controleur->printProfil();
	}
}