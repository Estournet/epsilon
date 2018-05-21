<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 15/12/2017
 * Time: 00:49
 */

class ModeleCommand extends DBMapper {
	public static function getCommands($idUser) {
		$req = self::$database->prepare("SELECT * FROM commands WHERE idUser = ?");
		$req->execute(array($idUser));
		$commandList = $req->fetchAll(PDO::FETCH_ASSOC);
		return $commandList;
	}
}