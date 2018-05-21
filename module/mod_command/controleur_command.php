<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 15/12/2017
 * Time: 00:49
 */

$module = 'command';
require_once(ROOT_DIR . "/module/mod_$module/modele_$module.php");
require_once(ROOT_DIR . "/module/mod_$module/vue_$module.php");

class ControleurCommand extends ControleurGenerique {
	public function printCommands() {
		if (isset($_SESSION['idUser'])) {
			$commands = ModeleCommand::getCommands($_SESSION['idUser']);
			$this->constructView('VueCommand', 'printCommands', array($commands));
		}
	}
}