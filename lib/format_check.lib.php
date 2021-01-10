<?php
	function checkUsername($username) {
	    if (!preg_match('/^[\w\x{4e00}-\x{9fa5}]{2,10}$/u', $username)) {
	        return '用户名格式不符合要求';
	    }
	    return true;
	}
	function checkPassword($password) {
	    if (!preg_match('/^\w{6,16}$/', $password)) {
	        return '密码格式不符合要求';
	    }
	    return true;
	}
	function checkPhone($num) {
	    if (!preg_match('/^1[3456789]\d{9}$/', $num)) {
	        return '手机号码不符合要求';
	    }
	    return true;
	}
?>