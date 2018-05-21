<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 11/12/2017
 * Time: 18:55
 */

class ModuleCategory extends ModuleGenerique{
	public function __construct() {
		$module = "category";
		require_once ROOT_DIR . "/module/mod_$module/controleur_$module.php";
		$this->controleur = new ControleurCategory();
		$this->controleur->printCategoryPage();

	}
}