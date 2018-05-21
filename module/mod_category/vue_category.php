<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 11/12/2017
 * Time: 18:55
 */

class VueCategory {
	public static function printCategory($categoryName, $description, array $books) {
		require_once ROOT_DIR . "/module/mod_accueil/vue_accueil.php";
		echo("
            <div class=\"jumbotron \">
                <div class=\"container\">
                    <h1 class=\"display-4\">" . ucfirst($categoryName) . "</h1>
                    <p class=\"lead\">$description</p>
                    <hr class=\"my-4\">
                </div>
            </div>
	    	");

		VueAccueil::printBooksSummary($books);

	}

	public static function printAllCategories(array $all){
		foreach ($all as $categoryName => $category) {
			self::printCategory($categoryName, $category['description'], $category['books']);
		}
	}
}