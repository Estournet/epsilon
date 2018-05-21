<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 11/12/2017
 * Time: 18:54
 */

$module = 'category';
require_once(ROOT_DIR . "/module/mod_$module/modele_$module.php");
require_once(ROOT_DIR . "/module/mod_$module/vue_$module.php");

class ControleurCategory extends ControleurGenerique {
	public function printCategoryPage() {
		if (isset($_GET['category'])) {
			$category = htmlspecialchars($_GET['category']);
			if ($category == 'all') {
				$categories = ModeleCategory::getAllCategories();
				$all = array();
				foreach ($categories as $category) {
					$all[$category]['books'] = ModeleCategory::getBooksList($category);
					$all[$category]['description'] = ModeleCategory::getCategoryDescription($category);
				}
				$this->constructView('VueCategory', 'printAllCategories', array($all));
			}
			else {
				$books = ModeleCategory::getBooksList($category);
				$description = ModeleCategory::getCategoryDescription($category);
				$this->constructView('VueCategory', 'printCategory', array($category, $description, $books));

			}
		}
	}
}
