<?php
	header('Content-Type:text/html;charset=utf-8');
	define('DB_DEBUG', true);
	require 'db_function.lib.php';
	db_init(array(
	    'host' => '127.0.0.1',
	    'user' => 'root',
	    'password' => '',
	    'dbname' => 'practical_training',
	    'charset' => 'utf8'
	));
	function input_get($name) {
	    return isset($_GET[$name]) ? trim($_GET[$name]) : '';
	}
	function input_post($name) {
	    return isset($_POST[$name]) ? trim($_POST[$name]) : '';
	}
	function filter($data, $func = array('trim', 'htmlspecialchars')) {
	    foreach ($func as $v) {
	        $data = $v((string)$data);
	    }
	    return $data;
	}
	function alert_back($msg) {
	    echo "<script>alert('$msg');window.location.href = 'index.php';</script>";
	    exit;
	}
?>