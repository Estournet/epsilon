<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 30/11/2017
 * Time: 22:49
 */

class VueNavbar {
	public static function printNavbar($isConnected, $isAdmin, array $categories) {
		echo('
	<nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="index.php?module=accueil">Plaisir De Lire</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        Catégories
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="index.php?module=category&category=all">Voir toutes</a>
                        <div class="dropdown-divider"></div>
                        ' . VueNavbar::printCategoriesInDropdown($categories) . '
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?module=about">À&nbsp;propos</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Rechercher" required>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
            </form>
			' . VueNavbar::adminButton($isAdmin) . '
			' . VueNavbar::connexionButton($isConnected) . '
            <a class="btn btn-outline-info ml-0 ml-lg-1 my-2 my-sm-0" role="button" href="index.php?module=cart"><i class="fas fa-shopping-cart"></i> Panier</a>
        </div>
	</nav>
		');
	}

	private static function printCategoriesInDropdown(array $categories) {
		$categoriesDropdown = "";
		foreach ($categories as $categorie) {
			$categorieEncoded = urlencode(htmlspecialchars($categorie));
			$categoriesDropdown .= "<a class=\"dropdown-item\" href=\"index.php?module=category&category=$categorieEncoded\">$categorie</a>";
		}
		return $categoriesDropdown;
	}

	private static function adminButton($isAdmin) {
		if ($isAdmin === true)
			return '<a class="btn btn-warning ml-0 ml-lg-4 my-2 my-sm-0 text-white" href="index.php?module=admin" role="button"><strong>Administration</strong></a>';
		else
			return '';
	}

	private static function connexionButton($isConnected) {
		if ($isConnected === true) {
			return '
				<div class="btn-group dropdown mx-0 mx-lg-2">
					<a class="btn btn-success  my-2 my-sm-0" href="index.php?module=profil"  role="button"><i class="far fa-user"></i> ' . $_SESSION["login"] . '</a>
					<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="index.php?module=command"><i class="fas fa-truck fa-fw"></i>&nbsp;Mes&nbsp;commandes</a>
						<a class="dropdown-item" href="index.php?module=profil"><i class="fas fa-user fa-fw"></i>&nbsp;Mon&nbsp;profil</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="index.php?module=connexion&action=deconnexion"><i class="fas fa-sign-out-alt fa-fw"></i>&nbsp;Se&nbsp;déconnecter</a>
					</div>
				</div>
			';
		}
		//			return '<a class="btn btn-success mx-0 mx-lg-2 my-2 my-sm-0" href="index.php?module=profil"  role="button"><i class="far fa-user"></i> ' . $_SESSION["login"] . '</a>';
		else
			return '<a class="btn btn-success mx-0 mx-lg-2 my-2 my-sm-0" href="index.php?module=connexion" role="button"><i class="fas fa-user-circle"></i> Connexion</a>';
	}
}
