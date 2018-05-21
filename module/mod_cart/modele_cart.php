<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 01/12/2017
 * Time: 21:52
 */

class ModeleCart extends DBMapper {
	public static function getBookInfo($idBook) {
		$req = self::$database->prepare("SELECT id_book, title, price, author_name FROM books, authors WHERE books.id_author = authors.id_author AND id_book = ?");
		$req->execute(array($idBook));
		$bookList = $req->fetch(PDO::FETCH_ASSOC);
		return $bookList;
	}

	public static function getUserInfo($idUser) {
		$req = self::$database->prepare("SELECT user_name, email, address, city FROM users WHERE id_user = ?");
		$req->execute(array($idUser));
		$userInfo = $req->fetch(PDO::FETCH_ASSOC);
		return $userInfo;
	}

	public static function addCommand($idCommand, $idUser, $status, array $products) {
		$req = self::$database->prepare("INSERT INTO commands VALUES (?, ?, ?)");
		$req->execute(array($idCommand, $idUser, $status));
		foreach ($products as $product) {
			$req = self::$database->prepare("INSERT INTO commands_items VALUES (?, ?, ?, ?)");
			$req->execute(array($idCommand, $product["id_book"], $product["quantity"], $product["price"]));
		}
	}
}