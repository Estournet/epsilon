<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 30/11/2017
 * Time: 22:49
 */

class ModuleNavbar extends ModuleGenerique {
	public function __construct() {
		$module = "navbar";
		require_once "module/mod_$module/controleur_$module.php";
		$this->controleur = new ControleurNavbar();
		$this->controleur->printNavbar();

	}
}