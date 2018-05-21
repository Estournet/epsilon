<?php

/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 25/11/2017
 * Time: 19:00
 */
$module = 'profil';
//require_once(ROOT_DIR."/module/mod_$module/modele_$module.php");
require_once(ROOT_DIR . "/module/mod_$module/vue_$module.php");

class ControleurProfil extends ControleurGenerique {

	public function printProfil() {
		$this->constructView('VueProfil', 'printProfil', array($_SESSION["login"]));
	}
}