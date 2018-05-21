<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 11/12/2017
 * Time: 18:55
 */

class ModeleCategory extends DBMapper{

	public static function getBooksList($category) {
		$req = self::$database->prepare("SELECT id_book, title, description, price, path, author_name, categorie_name FROM books, authors, categories WHERE books.id_author = authors.id_author AND books.id_categorie = categories.id_categorie AND categories.categorie_name = ? AND categories.id_categorie = books.id_categorie ORDER BY title");
		$req->execute(array($category));
		$bookList = $req->fetchAll(PDO::FETCH_ASSOC);
		return $bookList;
	}

	public static function getCategoryDescription($category) {
		$req = self::$database->prepare("SELECT category_description FROM categories WHERE categorie_name = ?");
		$req->execute(array($category));
		$categoryDescription = $req->fetch(PDO::FETCH_NUM);
		return $categoryDescription[0];
	}

	public static function getAllCategories() {
		$req = self::$database->prepare("SELECT categorie_name FROM categories");
		$req->execute(array());
		$categories = $req->fetchAll(PDO::FETCH_COLUMN);
		return $categories;
	}
}