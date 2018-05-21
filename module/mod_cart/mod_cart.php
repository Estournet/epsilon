<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 01/12/2017
 * Time: 21:52
 */

class ModuleCart extends ModuleGenerique {
	public function __construct() {
		$module = "cart";
		require_once "module/mod_$module/controleur_$module.php";
		$this->controleur = new ControleurCart();
		$this->controleur->printCartPage();
	}
}