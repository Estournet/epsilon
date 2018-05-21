<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 01/12/2017
 * Time: 01:47
 */
$module = 'about';
require_once(ROOT_DIR . "/module/mod_$module/vue_$module.php");

class ControleurAbout extends ControleurGenerique {
	public function printAbout() {
		$this->constructView("VueAbout", "printAbout", array());
	}
}