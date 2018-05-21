<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 01/12/2017
 * Time: 21:52
 */
$module = "cart";
require_once(ROOT_DIR . "/module/mod_$module/modele_$module.php");
require_once(ROOT_DIR . "/module/mod_$module/vue_$module.php");

class ControleurCart extends ControleurGenerique {
	public function printCartPage() {
		if (!isset($_SESSION["cart"]))
			$_SESSION["cart"] = array();

		if (isset($_GET["action"]))
			switch ($_GET["action"]) {
				case "emptyCart" :
					$_SESSION["cart"] = array();
					$this->constructView('VueCart', 'printCart', array());
					break;
				case "command" :
					$this->command();
					break;
				case "pay" :
					$this->pay();
					break;
				default :
					$this->printDefaultPage();
			}
		else
			$this->printDefaultPage();
	}

	private function getBooksInfo(array $cart) {
		$books = array();
		foreach ($cart as $bookInCart) {
			$bookInfo = ModeleCart::getBookInfo($bookInCart["idBook"]);
			$bookInfo["quantity"] = $bookInCart["quantity"];
			$books[] = $bookInfo;
		}
		return $books;
	}

	private function printDefaultPage() {
		$this->constructView('VueCart', 'printCart', array($this->getBooksInfo($_SESSION["cart"])));

	}

	private function command() {
		if (isset($_SESSION["idUser"])) {
			$_SESSION["invoice"] = array();
			$userInfo = ModeleCart::getUserInfo($_SESSION["idUser"]);
			$_SESSION['invoice']['idInvoice'] = strtoupper(substr(md5(rand()), 0, 7));
			$_SESSION['invoice']['date'] = date("D jS F Y");
			$_SESSION['invoice']['products'] = $this->getBooksInfo($_SESSION["cart"]);
			$taxes = 5.5;
			$_SESSION['invoice']['$totalPriceTTC'] = $this->getTotalPriceTTC($_SESSION['invoice']['products']);
			$totalPriceHT = $this->getTotalPriceHT($_SESSION['invoice']['$totalPriceTTC'], $taxes);

			$this->constructView('VueCart', 'printInvoice', array($userInfo, $_SESSION['invoice']['products'], $_SESSION['invoice']['idInvoice'], $_SESSION['invoice']['date'], $totalPriceHT, $taxes, $_SESSION['invoice']['$totalPriceTTC']));
		}
		else {
			$this->connexionBefore();
		}
	}

	private function getTotalPriceTTC(array $products) {
		$total = 0.00;
		foreach ($products as $product) {
			$total += $product["quantity"] * $product["price"];
		}
		return number_format($total, 2, '.', '');

	}

	private function getTotalPriceHT($totalPriceTTC, $taxes) {
		return number_format($totalPriceTTC * (1 - ($taxes / 100)), 2, '.', '&nbsp;');
	}

	// We assume that payment was okay
	private function pay() {
		if (isset($_SESSION["idUser"])) {
			$status = "Commandé";
			ModeleCart::addCommand($_SESSION['invoice']['idInvoice'], $_SESSION["idUser"], $status, $_SESSION['invoice']['products']);

			$_SESSION["cart"] = array();
			$_SESSION["invoice"] = array();
			$this->constructView('VueCart', 'printSuccessOrder', array());
		}
		else
			$this->connexionBefore();
	}

	private function connexionBefore() {
		require_once(ROOT_DIR . "module/mod_connexion/controleur_connexion.php");
		require_once(ROOT_DIR . "/module/mod_connexion/mod_connexion.php");
		$this->constructView('VueConnexion', 'printConnexion', array(array()));
	}
}