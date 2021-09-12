<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
	header("location: ./view/restrito.php");
}

if (empty($_SESSION['usuario'])) {
    header("location: ./view/public.php");
}

?>