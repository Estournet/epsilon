<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 27/11/2017
 * Time: 23:21
 */

class ModeleAdmin extends DBMapper {

	public static function addBook($title, $idAuthor, $description, $idCategorie, $price) {
		$req = self::$database->prepare("INSERT INTO books (title, id_author, id_categorie, description, price) VALUES (?, ?, ?, ?, ?)");
		$req->execute(array($title, $idAuthor, $idCategorie, $description, $price));
		$req = self::$database->prepare("SELECT LAST_INSERT_ID()");
		$req->execute();
		$idBook = $req->fetch(PDO::FETCH_NUM);
		return $idBook[0];
	}

	public static function getAuthorId($author) {
		$req = self::$database->prepare("SELECT id_author FROM authors WHERE author_name = ?");
		$req->execute(array($author));
		$idAuthor = $req->fetch(PDO::FETCH_NUM);
		return $idAuthor[0];
	}

	public static function getCategorieId($categorie) {
		$req = self::$database->prepare("SELECT id_categorie FROM categories WHERE categorie_name = ?");
		$req->execute(array($categorie));
		$idCategorie = $req->fetch(PDO::FETCH_NUM);
		return $idCategorie[0];
	}

	public static function updatePath($idBook, $path) {
		$req = self::$database->prepare("UPDATE books SET path = ? WHERE id_book= ?");
		$req->execute(array($path, $idBook));
	}

	public static function getCategories() {
		$req = self::$database->prepare("SELECT categorie_name FROM categories ORDER BY categorie_name");
		$req->execute(array());
		$categories = $req->fetchAll(PDO::FETCH_COLUMN);
		return $categories;
	}

	public static function getAuthors() {
		$req = self::$database->prepare("SELECT author_name FROM authors ORDER BY author_name ");
		$req->execute(array());
		$authors = $req->fetchAll(PDO::FETCH_COLUMN);
		return $authors;
	}

	public static function getBooks() {
		$req = self::$database->prepare("SELECT id_book, title, path, author_name FROM books, authors, categories WHERE books.id_author = authors.id_author AND books.id_categorie = categories.id_categorie ORDER BY title");
		$req->execute();
		$bookList = $req->fetchAll(PDO::FETCH_ASSOC);
		return $bookList;
	}

	public static function removeBook($idBook) {
		$req = self::$database->prepare("DELETE FROM books WHERE id_book = ?");
		$success = $req->execute(array($idBook));
		return $success === true ? 1 : 0;
	}

	public static function addCategory($categoryName, $categoryDescription = "") {
		$req = self::$database->prepare("INSERT INTO categories (categorie_name, category_description) VALUES (?,?)");
		$success = $req->execute(array($categoryName, $categoryDescription));
		return $success === true ? 1 : 0;

	}

	public static function removeCategory($categoryName) {
		$req = self::$database->prepare("DELETE FROM categories WHERE categorie_name = ?");
		$success = $req->execute(array($categoryName));
		return $success === true ? 1 : 0;

	}

	public static function removeAuthor($authorName) {
		$req = self::$database->prepare("DELETE FROM authors WHERE author_name = ?");
		$success = $req->execute(array($authorName));
		return $success === true ? 1 : 0;
	}

	public static function addAuthor($authorName) {
		$req = self::$database->prepare("INSERT INTO authors (author_name) VALUES (?)");
		$success = $req->execute(array($authorName));
		return $success === true ? 1 : 0;
	}

	public static function addToNew($idBook) {
		$req = self::$database->prepare("INSERT INTO new (id_book) VALUES (?)");
		$success = $req->execute(array($idBook));
		return $success === true ? 1 : 0;
	}

	public static function removeFromNew($idBook) {
		$req = self::$database->prepare("DELETE FROM new WHERE id_book = ?");
		$success = $req->execute(array($idBook));
		return $success === true ? 1 : 0;
	}

	public static function getNewBooks() {
		$req = self::$database->prepare("SELECT books.id_book, title, path, author_name FROM books, authors, categories, new WHERE books.id_author = authors.id_author AND books.id_categorie = categories.id_categorie AND books.id_book = new.id_book ORDER BY title");
		$req->execute();
		$bookList = $req->fetchAll(PDO::FETCH_ASSOC);
		return $bookList;
	}
}