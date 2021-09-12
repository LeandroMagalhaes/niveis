<?php

define("MENU_PATH", "../view/components/menu/");

function menu() {

	if (isset($_SESSION['nivel'])) {
		$nivel_usuario = $_SESSION['nivel'];

		if ($nivel_usuario == 0) {
			include MENU_PATH . "menu_adm.php";
		} else if ($nivel_usuario == 1) {
			include MENU_PATH . "menu_tesoureiro.php";
		} else if ($nivel_usuario == 2) {
			include MENU_PATH . "menu_bravo.php";
		}
	} else {
		include MENU_PATH . "menu_publico.php";
	}
}

