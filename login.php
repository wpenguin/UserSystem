<?php
	require './lib/init.lib.php';
	$error = array();
	$usernameerror = array();
	$passworderror = array();
	$codeerror = array();
	if (!empty($_POST)) {
	    $username = input_post('username');
	    $password = input_post('password');
	    $code = input_post('captcha');
	    require './lib/format_check.lib.php';
	    if (($result = checkUsername($username)) !== true) {
	        $usernameerror[] = $result;
	    }
	    if (($result = checkPassword($password)) !== true) {
	        $passworderror[] = $result;
	    }
	    session_start();
	    if(empty($_SESSION['captcha_code'])){
			$codeerror[] = '验证码已过期。';
		} elseif(strtolower($code) != strtolower($_SESSION['captcha_code'])){
			$codeerror[] = '验证码错误。';
		} else{}
		unset($_SESSION['captcha_code']);
	    if (empty($usernameerror) && empty($passworderror) && empty($codeerror)) {
	        $username = db_escape(filter($username));
	        $sql = "select `id`,`password` from `t_users` where `username`='$username'";
	        $rst = db_query($sql);
	        if(mysqli_num_rows($rst) == '0'){
	        	$usernameerror[] = '用户不存在哦~点击右下角去注册亲。';
	        }else{
	            $row = mysqli_fetch_assoc($rst); 
	            $password_db = md5($password);
	            if ($password_db == $row['password']) {
	                if (isset($_POST['auto_login']) && $_POST['auto_login']=='on') {
	                    $ua = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
	                    $password_cookie = md5($row['password']);
	                    $cookie_expire = time() + 2592000;
	                    setcookie('username', $username, $cookie_expire); 
	                    setcookie('password', $password_cookie, $cookie_expire); 
	                }
	                $_SESSION['userinfo'] = array(
	                    'id' => $row['id'], 
	                    'username' => $username
	                );
	                header('Location: index.php');
	                exit;
	            }
	            $passworderror[] = '密码错误了哦~好好想想密码。';
	        }
	    }
	}
	if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
	    $username = $_COOKIE['username'];
	    $password = $_COOKIE['password'];
	    $username = db_escape(filter($username));
	    $sql = "select `id`,`password` from `user` where `username`='$username'";
	    if ($rst = db_query($link, $sql)) { 
	        $row = mysqli_fetch_assoc($rst);
	        $ua = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
	        $password_cookie = md5($row['password']);
	        if ($password == $password_cookie) {
	            session_start();
	            $_SESSION['userinfo'] = array(
	                'id' => $row['id'], 
	                'username' => $username
	            );
	            header('Location: index.php');
	            exit;
	        }
	    }
	    $error[] = '登录状态已失效，请重新登录。';
	}
	require './view/login.html';
?>