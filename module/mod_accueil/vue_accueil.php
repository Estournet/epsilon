<?php

class VueAccueil {
	public static function printHomepage(array $books, array $newBooks) {
		self::printNewBooks($newBooks);
		self::printBooksSummary($books);
	}

	public static function printBooksSummary($books) {
		echo("
		<div class='container-fluid'>
			<div class=\"row\"> 
				<div class='card-columns'>
		");
		foreach ($books as $book)
			self::printBookSummary($book);
		echo("
				</div>
			</div>
		</div>
		");
	}

	private static function printBookSummary(array $bookInfo) {
		$id_book = $bookInfo['id_book'];
		$title = $bookInfo['title'];
		$fullDescription = $bookInfo['description'];
		$price = $bookInfo['price'];
		$path = $bookInfo['path'];
		$authorName = $bookInfo['author_name'];

		$lengthMax = 100;
		if (strlen($fullDescription) > $lengthMax) {
			$description = substr($fullDescription, 0, $lengthMax);
			$description = substr($description, 0, strrpos($description, ' ')) . "&nbsp;<a href='#' data-toggle=\"modal\" data-target=\"#product_view_$id_book\">[...]</a >";
		}
		else
			$description = $fullDescription;

		echo "
			<div class=\"card\">
				<a href='#' data-toggle=\"modal\" data-target=\"#product_view_$id_book\">
					<img class=\"card-img-top \" alt=\"couverture du livre $title\" src=\"./img/book_covers/$path\">
				</a>
				<div class=\"card-block\">
					<h4 class=\"card-title\">
						<a href='#' data-toggle=\"modal\" data-target=\"#product_view_$id_book\">$title</a>
					</h4>
					<div class=\"meta\">
						<a href=\"#\">$authorName</a>
					</div>
					<div class=\"card-text\">$description</div>
				</div>
				<div class=\"card-footer\">
					<span class=\"float-right\">$price €</span>
				</div>
            </div>";

		self::printModal($bookInfo);
	}
	// Source : https://bootsnipp.com/snippets/featured/ecommerce-quick-view-popup-amp-product-row

	private static function printModal($bookInfo) {
		$idBook = $bookInfo['id_book'];
		$title = $bookInfo['title'];
		$description = $bookInfo['description'];
		$price = $bookInfo['price'];
		$path = $bookInfo['path'];
		$authorName = $bookInfo['author_name'];
		$categorieName = $bookInfo['categorie_name'];

		echo("
			<div class=\"modal fade product_view \" id=\"product_view_$idBook\">
				<div class=\"modal-dialog\">
					<div class=\"modal-content\">
						<div class=\"modal-body\">
							<div class=\"row\">
								<div class=\"col-sm product_img\">
									<img src=\"img/book_covers/$path\" class=\"img-fluid mx-auto d-block\" alt=\"couverture du livre $title\" >
								</div>
								<div class=\"col-sm product_content\">
									<div class=\"form-inline \">		
											<h4 class='mr-3'>$title</h4>
											<span class=\"badge badge-info \">#$categorieName</span>
									</div>
									<div class=\"meta\">
										<a href=\"#\">$authorName</a>
									</div>
									<p>$description</p>
									<form id=\"addToCart\" class=\"form-inline\" action=\"javascript:void(0);\">
										<input id=\"idBook\" name=\"idBook\" type=\"hidden\" value=\"$idBook\">
										<select class=\"form-control mr-3 my-3 my-sm-0\" name=\"quantity\" required>
											<option value=\"\">Quantité</option> " . self::fromXtoYSelect(1, 20) . "
										</select>
										<button id='submitButton' type=\"submit\" class=\"btn btn-primary\">
											<i class=\"fas fa-cart-arrow-down\"></i> Ajouter au panier
										</button>
									</form>
									<p class='text-right display-1'>$price €</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>");
	}

	private static function fromXtoYSelect($x, $y) {
		$string = "";
		for ($i = $x; $i <= $y; $i++)
			$string .= "<option value=\"$i\">$i</option>";
		return $string;
	}

	private static function printNewBooks(array $newBooks) {
		if (!empty($newBooks)) {
			$newBooksSummary = '';
			foreach ($newBooks as $newBook)
				$newBooksSummary .= self::printNewBookSummary($newBook);

			echo("
            <div class=\"jumbotron \">
                <div class=\"container\">
                    <h1 class=\"display-4\">Nouveautés</h1>
                    <p class=\"lead\">En ces périodes de fêtes, découvrez vite nos nouveautés et offrez un Noël passionnant à vos proches&nbsp;!</p>
                    <hr class=\"my-4\">
                    <div class='row'>
                        $newBooksSummary
                    </div>
                </div>
            </div>
	    	");
		}
	}

	private static function printNewBookSummary($newBook) {
		$id_book = $newBook['id_book'];
		$title = $newBook['title'];
		$path = $newBook['path'];

		return "
			<div class=\"col-md-3 col-xs-6\">
                <a href='#' data-toggle=\"modal\" data-target=\"#product_view_$id_book\">
                    <img class=\"card-img-top\" alt=\"couverture du livre $title\" src=\"./img/book_covers/$path\">
                </a>
                <button type=\"button\" class=\"btn btn-primary mt-2 mb-3 col\" data-toggle=\"modal\" data-target=\"#product_view_$id_book\">Vue détaillée</button>
            </div> " . self::printModal($newBook);
	}
}