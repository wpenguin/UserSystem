<?php
	session_start();
	if (isset($_GET['action']) && $_GET['action'] == 'logout') {
	    setcookie('username', '', time() - 1);
	    setcookie('password', '', time() - 1);
	    unset($_SESSION['userinfo']);
	    if(empty($_SESSION)) {
	        session_destroy();
	    }
	    header('Location: index.php');
	    exit;
	}
	if (isset($_SESSION['userinfo'])) {
	    $login = true;
	    $userinfo = $_SESSION['userinfo']; 
	} else {
	    $login = false;
	}
?>