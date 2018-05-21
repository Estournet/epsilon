<?php

/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 25/11/2017
 * Time: 00:51
 */


class ModeleAccueil extends DBMapper {

	public static function getBooksList() {
		$req = self::$database->prepare("SELECT id_book, title, description, price, path, author_name, categorie_name FROM books, authors, categories WHERE books.id_author = authors.id_author AND books.id_categorie = categories.id_categorie ORDER BY title");
		$req->execute();
		$bookList = $req->fetchAll(PDO::FETCH_ASSOC);
		return $bookList;
	}

	public static function getNewBooksList() {
		$req = self::$database->prepare("SELECT books.id_book, title, description, price, path, author_name, categorie_name FROM books, authors, categories, new WHERE books.id_author = authors.id_author AND books.id_categorie = categories.id_categorie AND new.id_book = books.id_book ORDER BY title");
		$req->execute();
		$bookList = $req->fetchAll(PDO::FETCH_ASSOC);
		return $bookList;
	}

}
