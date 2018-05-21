<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 07/12/2017
 * Time: 10:29
 */

session_start();

if (!isset($_SESSION['cart']))
	$_SESSION['cart'] = array();

$_SESSION['cart'][] = array("quantity" => $_POST["quantity"], "idBook" => $_POST["idBook"]);