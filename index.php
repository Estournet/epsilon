<?php
session_start();
setlocale(LC_TIME, 'french');
define('ROOT_DIR', __DIR__);
require_once(ROOT_DIR . "/dbmapper.php");
require_once(ROOT_DIR . "/include_generique.php");
require_once(ROOT_DIR . "/params_connexion.php");
DBMapper::init($dns, $user, $password);
?>
<!doctype html>
<html lang="fr">
<head>
    <title>Projet Epsilon</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="img/favicon.png" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Theme material-->
    <!-- <link rel="stylesheet" href="https://bootswatch.com/4/materia/bootstrap.min.css"> -->

    <!-- Font Awesome v5 -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>

    <!--  Animations https://daneden.github.io/animate.css/-->
    <link rel="stylesheet" href="css/animate.css">

    <!-- My own CSS -->
    <link rel="stylesheet" href="css/css.css">
</head>
<body>
<div class="container">

	<?php
	require_once(ROOT_DIR . "/module/mod_navbar/mod_navbar.php");
	$navbarModule = new ModuleNavbar();
	$navbarModule->display();

	if (isset ($_GET ['module']))
		$module = $_GET ['module'];
	else
		$module = "accueil";

	// Permet d'inclure un module au choix
	if (isset ($module)) {
		/** @var ModuleGenerique $moduleObjet */

		require_once(ROOT_DIR . "/module/mod_$module/mod_$module.php");
		$classeModule = "Module$module";
		$moduleObjet = new $classeModule ();
		$moduleObjet->display();
	}

	/*
	 * AAAAARCHI UTILE POUR AFFICHER UN TABLEAU EN DEUX DEUX ?> <pre> <?php print_r($tab); ?> </pre> <?php
	 */
	?>

</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
        integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
        crossorigin="anonymous"></script>

<!--Bootstrap Notify : http://bootstrap-notify.remabledesigns.com/-->
<script src="js/bootstrap-notify.js"></script>
<!--My own JS-->
<script src="js/app.js"></script>

</body>
</html>