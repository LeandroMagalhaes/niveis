<?php

require_once "funcoes.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

Funcoes::sair("../index.php");
