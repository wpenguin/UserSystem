<?php
	require './lib/init.lib.php';
	$error = array();
	$usernameError = array();
	$passwordError = array();
	$phoneError = array();
	function showRegPage() {
	    $error = $GLOBALS['error']; 
	    $usernameError = $GLOBALS['usernameError'];
	    $passwordError = $GLOBALS['passwordError'];
	    $phoneError = $GLOBALS['phoneError'];
	    require './view/regist.html';
	    exit;
	}
	if (empty($_POST)) {
    	showRegPage();
	}
	$check_fields = array('username', 'password', 'phone');
	foreach ($check_fields as $v) {
    	if (empty($_POST[$v])) {
       		$error[] = $v . '不能为空！';
    	}
	}
	if (!empty($error)) {
   		showRegPage(); 
	}
	$link = mysqli_connect('localhost', 'root', '') or exit('数据库连接失败！');
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$phone = trim($_POST['phone']);
	require './lib/format_check.lib.php';
	if (($result = checkUsername($username)) !== true) {
	    $usernameError[] = $result;
	}
	if (($result = checkPassword($password)) !== true) {
	    $passwordError[] = $result;
	}
	if (($result = checkphone($phone)) !== true) {
	    $phoneError[] = $result;
	}
	if (empty($error) && empty($usernameError) && empty($passwordError) && empty($phoneError)) {
	    $username = db_escape(filter($username));
		$phone = db_escape(filter($phone));
		$sql = "select `id` from `t_users` where `username`='$username'";
		$rst = db_query($sql);
		if (mysqli_fetch_row($rst)) {
			if(!empty($usernameError)){
				showRegPage();
			}else{
				 $usernameError[] = '此用户名太受欢迎，请更换一个。';
		    	showRegPage();
			}
		}
		$sql = "select `id` from `t_users` where `phone`='$phone'";
		$rst = db_query($sql);
		if (mysqli_fetch_row($rst)) {
		    $phoneError[] = '该号码已被注册过。';
		    showRegPage();
		}
		$password = md5($password);
		$sql = "insert into `t_users`(`username`,`password`,`phone`) values('$username','$password','$phone')";
		$rst = db_query($sql);
		if ($rst) {
		    session_start();
		    $id = mysqli_insert_id($link);
		    $_SESSION['userinfo'] = array(
		        'id' => $id,
		        'username' => $username
		    );
		    alert_back('注册成功！');
		    exit;
		} else {
		    $error[] = '注册失败，数据库裂开。';
		    showRegPage();
		}
	}else{
		showRegPage();
	}
?>