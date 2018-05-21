<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 27/11/2017
 * Time: 23:21
 */
$module = 'admin';
require_once(ROOT_DIR . "/module/mod_$module/modele_$module.php");
require_once(ROOT_DIR . "/module/mod_$module/vue_$module.php");

class ControleurAdmin extends ControleurGenerique {

	public function printAdminPage() {
		if ($_SESSION['isAdmin']) {
			if (isset($_GET['action']))
				switch ($_GET['action']) {
					case "addBook" :
						$dataReturn = $this->addBook();
						break;
					case "removeBook":
						$dataReturn = $this->removeBook();
						break;
					case "addCategory" :
						$dataReturn = $this->addCategory();
						break;
					case "removeCategory" :
						$dataReturn = $this->removeCategory();
						break;
					case "addAuthor" :
						$dataReturn = $this->addAuthor();
						break;
					case "removeAuthor":
						$dataReturn = $this->removeAuthor();
						break;
					case "addToNew" :
						$dataReturn = $this->addToNew();
						break;
					case"removeFromNew":
						$dataReturn = $this->removeFromNew();
						break;
					default:
						$dataReturn = null;
				}
			else
				$dataReturn = null;

			$categories = ModeleAdmin::getCategories();
			$authors = ModeleAdmin::getAuthors();
			$books = ModeleAdmin::getBooks();
			$newBooks = ModeleAdmin::getNewBooks();
			$this->constructView('VueAdmin', 'printAdminPage', array($categories, $authors, $books, $newBooks, $dataReturn));

		}
		else {
			$this->constructView('VueAdmin', 'printNotAllowedPage', array());

		}
	}

	private function addBook() {
		if (isset($_POST["title"]) && isset($_POST["author"]) && isset($_POST["description"]) && isset($_POST["categorie"]) && isset($_POST["price"])) {
			$title = htmlspecialchars($_POST["title"]);
			$author = ModeleAdmin::getAuthorId(htmlspecialchars($_POST["author"]));
			$description = htmlspecialchars($_POST["description"]);
			$categorie = ModeleAdmin::getCategorieId(htmlspecialchars($_POST["categorie"]));
			$price = $this->checkIfIsValidPrice(htmlspecialchars($_POST["price"]));

			$idBook = ModeleAdmin::addBook($title, $author, $description, $categorie, $price);

			if ($idBook == 0) {
				$dataReturn['success'] = 0;
				$dataReturn['message'] = "Impossible d'insérer le livre dans la base de donnée";
				return $dataReturn;
			}

			if (isset($_FILES) && !empty($_FILES)) {
				$uploaddir = ROOT_DIR . '/img/book_covers/';
				$extension = pathinfo($_FILES['coverFile']["name"], PATHINFO_EXTENSION);
				$file = "$idBook.$extension";
				$uploadfile = $uploaddir . basename($file);

				if (move_uploaded_file($_FILES['coverFile']['tmp_name'], $uploadfile)) {
					ModeleAdmin::updatePath($idBook, $file);
					$dataReturn['success'] = 1;
					$dataReturn['message'] = "Le livre a bien été ajouté";
					return $dataReturn;
				}
				else {
					$dataReturn['success'] = 1;
					$dataReturn['message'] = "Le livre a bien été ajouté, sans photo de couverture toutefois";
					return $dataReturn;
				}
			}
			else {
				$dataReturn['success'] = 1;
				$dataReturn['message'] = "Le livre a bien été ajouté, sans photo de couverture toutefois";
				return $dataReturn;
			}
		}
		$dataReturn['success'] = 0;
		$dataReturn['message'] = "Veuillez remplir les champs obligatoires du formulaire";
		return $dataReturn;
	}

	private function checkIfIsValidPrice($price) {
		if (preg_match('/^-?(?:\d+|\d*\.\d+)$/', $price) === 1)
			return $price;
		else
			return null;
	}

	private function removeBook() {
		if (isset($_POST['idBook'])) {
			$dataReturn['success'] = ModeleAdmin::removeBook(htmlspecialchars($_POST['idBook']));
			if ($dataReturn['success'] == 1)
				$dataReturn['message'] = "Le livre a bien été supprimé";
			else
				$dataReturn['message'] = "Une erreur est survenue";
		}
		else {
			$dataReturn['success'] = 0;
			$dataReturn['message'] = "Veuillez sélectionner un livre à supprimer";
		}

		return $dataReturn;
	}

	private function addCategory() {
		if (isset($_POST["categoryName"])) {
			if (isset($_POST["categoryDescription"]))
				$dataReturn["success"] = ModeleAdmin::addCategory(htmlspecialchars($_POST["categoryName"]), htmlspecialchars($_POST["categoryDescription"]));
			else
				$dataReturn["success"] = ModeleAdmin::addCategory(htmlspecialchars($_POST["categoryName"]));

			if ($dataReturn["success"] == 1)
				$dataReturn["message"] = "La catégorie " . htmlspecialchars($_POST["categoryName"]) . " a été ajoutée";
			else
				$dataReturn["message"] = "Impossible d'ajouter la catégorie. Êtes vous sûr qu'elle n'existe pas déjà ?";
			return $dataReturn;
		}
		else {
			$dataReturn["success"] = 0;
			$dataReturn["message"] = "Veuillez spécifier un nom de catégorie";
			return $dataReturn;
		}
	}

	private function removeCategory() {
		if (isset($_POST['categoryName'])) {
			$dataReturn['success'] = ModeleAdmin::removeCategory(htmlspecialchars($_POST['categoryName']));
			if ($dataReturn['success'] == 1)
				$dataReturn['message'] = "La catégorie a bien été supprimé";
			else
				$dataReturn['message'] = "Une erreur est survenue";
		}
		else {
			$dataReturn['success'] = 0;
			$dataReturn['message'] = "Veuillez sélectionner une catégorie à supprimer";
		}

		return $dataReturn;
	}

	private function removeAuthor() {
		if (isset($_POST['authorName'])) {
			$dataReturn['success'] = ModeleAdmin::removeAuthor(htmlspecialchars($_POST['authorName']));
			if ($dataReturn['success'] == 1)
				$dataReturn['message'] = "L'auteur a bien été supprimé";
			else
				$dataReturn['message'] = "Une erreur est survenue";
		}
		else {
			$dataReturn['success'] = 0;
			$dataReturn['message'] = "Veuillez sélectionner un auteur à supprimer";
		}

		return $dataReturn;
	}

	private function addAuthor() {
		if (isset($_POST["authorName"])) {
			$dataReturn["success"] = ModeleAdmin::addAuthor(htmlspecialchars($_POST["authorName"]));
			if ($dataReturn["success"] == 1)
				$dataReturn["message"] = "L'auteur " . htmlspecialchars($_POST["authorName"]) . " a été ajoutée";
			else
				$dataReturn["message"] = "Impossible d'ajouter l'auteur. Êtes vous sûr qu'il n'existe pas déjà ?";
			return $dataReturn;
		}
		else {
			$dataReturn["success"] = 0;
			$dataReturn["message"] = "Veuillez spécifier un auteur";
			return $dataReturn;
		}
	}

	private function addToNew() {
		if (isset($_POST["idBook"])) {
			$dataReturn["success"] = ModeleAdmin::addToNew(htmlspecialchars($_POST["idBook"]));
			if ($dataReturn["success"] == 1)
				$dataReturn["message"] = "Le livre a été ajouté aux nouveautés";
			else
				$dataReturn["message"] = "Impossible d'ajouter le livre aux nouveautés. Êtes vous sûr qu'il n'est pas déjà présent dans les nouveautés ?";
			return $dataReturn;
		}
		else {
			$dataReturn["success"] = 0;
			$dataReturn["message"] = "Veuillez spécifier le livre à ajouter aux nouveautés";
			return $dataReturn;
		}
	}

	private function removeFromNew() {
		if (isset($_POST['idBook'])) {
			$dataReturn['success'] = ModeleAdmin::removeFromNew(htmlspecialchars($_POST['idBook']));
			if ($dataReturn['success'] == 1)
				$dataReturn['message'] = "La livre a bien été supprimé des nouveautés";
			else
				$dataReturn['message'] = "Une erreur est survenue";
		}
		else {
			$dataReturn['success'] = 0;
			$dataReturn['message'] = "Veuillez sélectionner un livre à supprimer des nouveautés";
		}

		return $dataReturn;
	}
}