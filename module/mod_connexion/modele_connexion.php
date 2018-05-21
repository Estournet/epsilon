<?php

/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 25/11/2017
 * Time: 10:43
 */

// Password are hashed with SHA256
class ModeleConnexion extends DBMapper {

	public static function register($login, $password, $email, $userName, $address, $city) {
		// Checks if the login is available
		$req = self::$database->prepare("SELECT COUNT(login) AS count FROM users WHERE login = ?");
		$req->execute(array($login));
		$queryReturn = $req->fetch(PDO::FETCH_ASSOC);

		if ($queryReturn["count"] > 0) {
			$return["success"] = false;
			$return["message"] = "Ce login est déjà utilisé.";
			return $return;
		}

		// Checks if the email is available
		$req = self::$database->prepare("SELECT COUNT(email) AS count FROM users WHERE email = ?");
		$req->execute(array($email));
		$queryReturn = $req->fetch(PDO::FETCH_ASSOC);
		if ($queryReturn["count"] > 0) {
			$return["success"] = false;
			$return["message"] = "Cet email est déjà utilisée.";
			return $return;
		}

		// Inserts the new user and connects him
		$req = self::$database->prepare("INSERT INTO users(login, email, password, user_name, address, city) VALUES (?, ?, ?, ?, ?, ?)");
		$params = array($login, $email, hash("sha256", $password), $userName, $address, $city);
		$req->execute($params);

		return self::connect($login, $password);
	}

	public static function connect($login, $password) {
		$req = self::$database->prepare("SELECT id_user, login FROM users WHERE login = ? AND password = ?");
		$params = array($login, hash("sha256", $password));
		$req->execute($params);
		$queryReturn = $req->fetch(PDO::FETCH_ASSOC);

		$req = self::$database->prepare("SELECT COUNT(id_user) AS count FROM admins WHERE id_user = ?");
		$params = array($queryReturn['id_user']);
		$req->execute($params);
		$count = $req->fetch(PDO::FETCH_ASSOC);

		if ($count["count"] == 1)
			$_SESSION["isAdmin"] = true;
		else
			$_SESSION["isAdmin"] = false;

		if (isset($queryReturn['id_user'])) {
			$return["success"] = true;
			$return["data"] = $queryReturn;
			return $return;
		}
		else {
			$return["success"] = false;
			$return["message"] = "Mauvais login et/ou mauvais mot de passe.";
			return $return;
		}
	}
}