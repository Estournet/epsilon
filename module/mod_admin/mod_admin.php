<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 27/11/2017
 * Time: 23:21
 */

class ModuleAdmin extends ModuleGenerique {
	public function __construct() {
		$module = "admin";
		require_once "module/mod_$module/controleur_$module.php";
		$this->controleur = new ControleurAdmin();
		$this->controleur->printAdminPage();

	}
}