<?php
$module = 'accueil';
require_once(ROOT_DIR . "/module/mod_$module/modele_$module.php");
require_once(ROOT_DIR . "/module/mod_$module/vue_$module.php");

class ControleurAccueil extends ControleurGenerique {
	public function printHomepage() {
		$books = ModeleAccueil::getBooksList();
		$newBooks = ModeleAccueil::getNewBooksList();
		$this->constructView('VueAccueil', 'printHomepage', array($books, $newBooks));
	}
}
