<?php

/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 25/11/2017
 * Time: 00:45
 */

class DBMapper {

	/** @var  PDO */
	public static $database;

	public static function init($dns, $user, $password) {
		try {//Début connexion
			self::$database = new PDO ($dns, $user, $password);
			self::$database->query("SET NAMES UTF8");//Solution encodage UTF8
		} catch (Exception $e) {
			die("Erreur : " . $e->getMessage());
		}//Fin connexion
	}
}
