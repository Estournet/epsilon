<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 01/12/2017
 * Time: 01:47
 */

class ModuleAbout extends ModuleGenerique {
	public function __construct() {
		$module = "about";
		require_once ROOT_DIR . "/module/mod_$module/controleur_$module.php";
		$this->controleur = new ControleurAbout();

		$this->controleur->printAbout();

	}
}