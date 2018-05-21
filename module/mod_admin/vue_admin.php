<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 27/11/2017
 * Time: 23:21
 */

class VueAdmin {
	public static function printAdminPage(array $categories, array $authors, array $books, array $newBooks, array $dataReturn = null) {
		if (isset($dataReturn) && !empty($dataReturn)) {
			if ($dataReturn['success'] == 1)
				VueAdmin::printSuccessAlert($dataReturn['message']);
			if ($dataReturn['success'] == 0)
				VueAdmin::printErrorAlert($dataReturn['message']);
		}

		echo("
<div class=\"container\">
	<div class=\"row\">
		<!-- List group -->
		<div class='col'>
			<div class=\"list-group\" role=\"tablist\">
				<a class=\"list-group-item list-group-item-action active\" data-toggle=\"list\" href=\"#addProduct\" role=\"tab\">Ajouter des produits</a>
				<a class=\"list-group-item list-group-item-action\" data-toggle=\"list\" href=\"#deleteProduct\" role=\"tab\">Supprimer des produits</a>
				<a class=\"list-group-item list-group-item-action\" data-toggle=\"list\" href=\"#addAuthor\" role=\"tab\">Ajouter un auteur</a>
				<a class=\"list-group-item list-group-item-action\" data-toggle=\"list\" href=\"#removeAuthor\" role=\"tab\">Supprimer un auteur</a>
				<a class=\"list-group-item list-group-item-action\" data-toggle=\"list\" href=\"#addCategory\" role=\"tab\">Ajouter une catégorie</a>
				<a class=\"list-group-item list-group-item-action\" data-toggle=\"list\" href=\"#removeCategory\" role=\"tab\">Supprimer une catégorie</a>
				<a class=\"list-group-item list-group-item-action\" data-toggle=\"list\" href=\"#addToNew\" role=\"tab\">Ajouter aux nouveautés</a>
				<a class=\"list-group-item list-group-item-action\" data-toggle=\"list\" href=\"#removeFromNew\" role=\"tab\">Supprimer des nouveautés</a>
			</div>
		</div>
		
		<!-- Tab panes -->
		<div class='col-md-9 mt-md-0 mt-4'>
			<div class=\"tab-content\">
				<div class=\"tab-pane active\" id=\"addProduct\" role=\"tabpanel\">" . self::printAddProduct($categories, $authors) . "</div>
				<div class=\"tab-pane\" id=\"deleteProduct\" role=\"tabpanel\">" . self::printDeleteProduct($books) . "</div>
				<div class=\"tab-pane\" id=\"addAuthor\" role=\"tabpanel\">" . self::printAddAuthor() . "</div>
				<div class=\"tab-pane\" id=\"removeAuthor\" role=\"tabpanel\">" . self::printRemoveAuthor($authors) . "</div>
				<div class=\"tab-pane\" id=\"addCategory\" role=\"tabpanel\">" . self::printAddCategory() . "</div>
				<div class=\"tab-pane\" id=\"removeCategory\" role=\"tabpanel\">" . self::printRemoveCategory($categories) . "</div>
				<div class=\"tab-pane\" id=\"addToNew\" role=\"tabpanel\">" . self::printAddToNew($books) . "</div>
				<div class=\"tab-pane\" id=\"removeFromNew\" role=\"tabpanel\">" . self::printRemoveFromNew($newBooks) . "</div>
			</div>
		</div>
	</div>
</div>");

	}

	private static function printRemoveAuthor(array $authors) {
		return '
<form action="index.php?module=admin&action=removeAuthor" method="post">
    <div class="form-group ">
        <select class="form-control col" name="authorName" required>
            <option disabled selected>Choisissez un auteur</option>
            ' . self::printAuthorsInSelect($authors) . '
        </select>
    </div>
    <button type="submit" class="btn btn-danger btn-lg btn-block">Supprimer un auteur</button>
</form>
		';
	}

	private static function printAddAuthor() {
		return '
<form action="index.php?module=admin&action=addAuthor" method="post">
    <div class="form-group">
        <input type="text" class="form-control col" name="authorName" placeholder="Nom de l\'auteur" required>
    </div>
    <button type="submit" class="btn btn-success btn-lg btn-block">Ajouter un auteur</button>
</form>
		';
	}

	private static function printRemoveCategory(array $categories) {
		return '
<form action="index.php?module=admin&action=removeCategory" method="post">
    <div class="form-group ">
        <select class="form-control col" name="categoryName" required>
            <option disabled selected>Choisissez une catégorie</option>
            ' . self::printCategoriesInSelect($categories) . '
        </select>
    </div>
    <button type="submit" class="btn btn-danger btn-lg btn-block">Supprimer une catégorie</button>
</form>
		';
	}

	public static function printAddCategory() {
		return '
<form action="index.php?module=admin&action=addCategory" method="post">
    <div class="form-group">
        <input type="text" class="form-control col" name="categoryName" placeholder="Nom de la catégorie" required>
    </div>
    <div class="form-group ">
        <textarea class="form-control col" name="categoryDescription" placeholder="Description de la catégorie" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-success btn-lg btn-block">Ajouter une catégorie</button>
</form>
		';
	}

	public static function printNotAllowedPage() {
		echo('<h1 class="display-1"><i class="fas fa-exclamation-triangle"></i> Vous n\'êtes pas autorisé à accéder à cette page.</h1>');
	}

	private static function printDeleteProduct(array $books) {
		return '
<form action="index.php?module=admin&action=removeBook" method="post">
    <div class="form-group ">
        <select class="form-control col" name="idBook" required>
            <option disabled selected>Choisissez un livre</option>
            ' . self::printBooksInSelect($books) . '
        </select>
    </div>
    <button type="submit" class="btn btn-danger btn-lg btn-block">Supprimer un livre</button>
</form>
		';
	}

	private static function printSuccessAlert($message) {
		echo ' 
	<div class="alert alert-success alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Succès. </strong> ' . $message . '
	</div>';
	}

	private static function printErrorAlert($message) {
		echo ' 
	<div class="alert alert-danger alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Erreur. </strong> ' . $message . '
	</div>';
	}

	private static function printAddProduct(array $categories, array $authors) {
		return '
<form enctype="multipart/form-data" action="index.php?module=admin&action=addBook" method="post">
    <div class="form-group">
        <input type="text" class="form-control col" name="title" placeholder="Titre du livre" required>
    </div>
    <div class="form-group ">
        <select class="form-control col" name="author">
            <option disabled selected>Choisissez un auteur</option>
            ' . self::printAuthorsInSelect($authors) . '
        </select>
    </div>
     <div class="form-group ">
        <select class="form-control col" name="categorie">
            <option disabled selected>Choisissez une catégorie</option>
            ' . self::printCategoriesInSelect($categories) . '
        </select>
    </div>
    <div class="form-group ">
        <textarea class="form-control col" name="description" placeholder="Description du livre" rows="3" required></textarea>
    </div>
    <div class="form-group">
    	<div class="input-group">
        	<input type="text" pattern="[0-9]+([\.][0-9]{0,2})?" class="form-control col" name="price" placeholder="Prix" required>
			<div class="input-group-addon"><i class="fas fa-euro-sign"></i></div>
        </div>
    </div>

    <div class="form-group">
        <label class="custom-file col" id="customFile">
            <input type="file" name="coverFile" class="custom-file-input" accept="image/*">
            <span class="custom-file-control form-control-file"></span>
        </label>
    </div>
    <button type="submit" class="btn btn-success btn-lg btn-block">Ajouter un livre</button>
</form>
		';
	}

	private static function printAddToNew(array $books) {
		return '
<form action="index.php?module=admin&action=addToNew" method="post">
    <div class="form-group ">
        <select class="form-control col" name="idBook" required>
            <option disabled selected>Choisissez un livre</option>
            ' . self::printBooksInSelect($books) . '
        </select>
    </div>
    <button type="submit" class="btn btn-success btn-lg btn-block">Ajouter ce livre aux nouveautés</button>
</form>
		';
	}

	private static function printRemoveFromNew(array $newBooks) {
		return '
<form action="index.php?module=admin&action=removeFromNew" method="post">
    <div class="form-group ">
        <select class="form-control col" name="idBook" required>
            <option disabled selected>Choisissez un livre</option>
            ' . self::printBooksInSelect($newBooks) . '
        </select>
    </div>
    <button type="submit" class="btn btn-danger btn-lg btn-block">Supprimer ce livre des nouveautés</button>
</form>
		';
	}

	private static function printCategoriesInSelect(array $categories) {
		$str = "";
		foreach ($categories as $category) {
			$str .= "<option value='$category'>$category</option>";
		}
		return $str;
	}

	private static function printAuthorsInSelect(array $authors) {
		$str = "";
		foreach ($authors as $author) {
			$str .= "<option value='$author'>$author</option>";
		}
		return $str;
	}

	private static function printBooksInSelect(array $books) {
		$str = "";
		foreach ($books as $book) {
			if (isset($book["id_book"]))
				$str .= "<option value='" . $book['id_book'] . "'>" . $book['title'] . " (" . $book['author_name'] . ")</option>";
		}
		return $str;

	}
}