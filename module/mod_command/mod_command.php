<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 15/12/2017
 * Time: 00:49
 */
class ModuleCommand extends ModuleGenerique{
	public function __construct() {
		$module = "command";
		require_once ROOT_DIR . "/module/mod_$module/controleur_$module.php";
		$this->controleur = new ControleurCommand();
		$this->controleur->printCommands();

	}
}