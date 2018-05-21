<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 30/11/2017
 * Time: 22:48
 */

$module = 'navbar';
require_once(ROOT_DIR . "/module/mod_$module/modele_$module.php");
require_once(ROOT_DIR . "/module/mod_$module/vue_$module.php");
require_once(ROOT_DIR . "/module/mod_profil/mod_profil.php");

class ControleurNavbar extends ControleurGenerique {
	public function printNavbar() {
		$categories = ModeleNavbar::getCategories();
		if (!isset($_SESSION["isAdmin"]))
			$_SESSION["isAdmin"] = false;

		$this->constructView('VueNavbar', 'printNavbar', array(isset($_SESSION["login"]), $_SESSION["isAdmin"], $categories));
	}
}