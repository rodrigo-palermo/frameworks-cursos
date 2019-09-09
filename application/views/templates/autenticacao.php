<?php
if (!isset($_SESSION['autenticado']) || (isset($_SESSION['autenticado']) and $_SESSION['autenticado'] != true)) {
	$_SESSION['autenticado'] = false;
}
