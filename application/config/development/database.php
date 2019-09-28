<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$active_group = 'postgresql_development';
$query_builder = TRUE;

$database_url = 'postgres://postgres:admin@localhost:5432/ci_cursos';

$url = parse_url($database_url);
$url["path"] = ltrim($url["path"], "/");

$db['postgresql_development'] = array(
	'dsn'	=> '',
	'hostname' => $url["host"],
	'port' => $url["port"],
	'username' => $url["user"],
	'password' => $url["pass"],
	'database' => $url["path"],
	'dbdriver' => 'postgre',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE,
);
