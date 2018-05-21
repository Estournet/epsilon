<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 30/11/2017
 * Time: 22:49
 */

class ModeleNavbar extends DBMapper {

	public static function getCategories() {
		$req = self::$database->prepare("SELECT categorie_name FROM categories");
		$req->execute(array());
		$categories = $req->fetchAll(PDO::FETCH_COLUMN);
		return $categories;
	}
}