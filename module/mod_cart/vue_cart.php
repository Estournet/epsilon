<?php

/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 01/12/2017
 * Time: 21:52
 */
class VueCart {
	public static function printCart(array $books = array()) {
		if (!isset($books) || empty($books))
			echo("<h1>Votre panier est vide :-(</h1>");
		else
			echo("
				<h1>Mon panier</h1>
				<table class=\"table table-hover\">
				  <thead class=\"thead-light\">
					<tr>
					  <th scope=\"col\">Article</th>
					  <th scope=\"col\">Quantité</th>
					  <th scope=\"col\">Prix</th>
					</tr>
				  </thead>
				  <tbody>
					" . VueCart::printBooksInTable($books) . "
				  </tbody>
				</table>
				<a class=\"col col-md-3 col-xs-12 btn btn-primary float-right ml-0 ml-sm-2 my-2 my-md-0\" role=\"button\" href=\"index.php?module=cart&action=command\"><i class=\"fas fa-credit-card\"></i> Commander</a>
				<a id='emptyCartButton' class=\"col col-md-3 col-xs-12 btn btn-danger float-right ml-0 ml-sm-2 my-2 my-md-0\" role=\"button\" href=\"index.php?module=cart&action=emptyCart\"><i class=\"fas fa-trash-alt\"></i> Supprimer mon panier</a>
				");
	}

	public static function printInvoice(array $userInfos, array $booksAndPrices, $invoiceID, $date, $totalPriceHT, $taxes, $totalPriceTTC) {
		$userName = $userInfos["user_name"];
		$email = $userInfos["email"];
		$address = $userInfos["address"];
		$city = $userInfos["city"];

		echo "
<div class='row justify-content-center'>
    <div class='col col-md-10'>
        <div class=\"row\">
            <div class=\"col col-xs-6 col-sm-6 col-md-6\">
                <address>
                    <strong>$userName</strong><br>
                    $address<br>
                    $city<br>
                    Email&nbsp;: <a href='mailto:$email'>$email</a>
                </address>
            </div>
            <div class=\"col col-xs-6 col-sm-6 col-md-6 text-right\">
                <p>
                    <em>Date&nbsp;: $date</em>
                </p>
                <p>
                    <em>Commande&nbsp;: $invoiceID</em>
                </p>
            </div>
        </div>
        <div class=\"row\">
			<h1>Facture</h1>
            <table class=\"table table-hover\">
                <thead>
					<tr>
						<th class=\"col-xs-7\">Produit</th>
						<th class=\"col-xs-1 text-right\" >Quantité</th>
						<th class=\"col-xs-2 text-right\">Prix</th>
						<th class=\"col-xs-2 text-right\">Total</th>
					</tr>
                </thead>
                <tbody>
					" . self::printBooksInTableInvoice($booksAndPrices) . "
					<tr>
						<td>  </td>
						<td>  </td>
						<td class=\"text-right\">
							<p><strong>Total&nbsp;HT&nbsp;:</strong></p>
							<p><strong>TVA&nbsp;:</strong></p>
						</td>
						<td class=\"text-center\">
							<p><strong>$totalPriceHT&nbsp;€</strong></p>
							<p><strong>$taxes&nbsp;%</strong></p>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td class=\"text-right\"><h4><strong>Total&nbsp;TTC&nbsp;:</strong></h4></td>
						<td class=\"text-center text-danger\"><h4><strong>$totalPriceTTC&nbsp;€</strong></h4></td>
					</tr>
                </tbody>
            </table>
            
            <a href='index.php?module=cart&action=pay' type=\"button\" class=\"btn btn-success btn-lg btn-block\">Pay Now   <i class=\"fas fa-chevron-right\"></i></a>
        </div>
    </div>
		";
	}

	private static function printBooksInTable($books) {
		$str = '';
		foreach ($books as $book)
			$str .= '<tr>' . VueCart::printBookInTable($book) . '</tr>';
		return $str;
	}

	private static function printBookInTable($book) {
		$str = '<td>' . $book["title"] . ' (' . $book["author_name"] . ')</td> ';
		$str .= '<td> ' . $book["quantity"] . '</td> ';
		$str .= '<td> ' . $book["price"] . '&nbsp;€</td> ';
		return $str;
	}

	private static function printBooksInTableInvoice($booksAndPrices) {
		$str = '';
		foreach ($booksAndPrices as $book)
			$str .= '<tr>' . VueCart::printBookInTableInvoice($book) . '</tr>';
		return $str;
	}

	private static function printBookInTableInvoice($book) {
		$str = '<td><em>' . $book["title"] . ' (' . $book["author_name"] . ')</em></td> ';
		$str .= '<td class=\'text-right\'> ' . $book["quantity"] . '</td> ';
		$str .= '<td class=\'text-right\'> ' . $book["price"] . '&nbsp;€</td> ';
		$str .= '<td class=\'text-right\'> ' . $book["price"] * $book["quantity"] . '&nbsp;€</td> ';
		return $str;
	}

	public static function printSuccessOrder() {
		echo('
            <div class="row">
                <p class="text-center display-1">Votre commande est prête <br><i class="mt-4 fas fa-space-shuttle fa-5x"></i></p>
            </div>
		');
	}
}