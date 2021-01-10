<?php
	if (!defined('DB_DEBUG')) {
	    defined('DB_DEBUG', false);
	}
	function db_init($config = array()) {
	    static $link;
	    if ($link) {
	        return $link;
	    }
	    $def_config = array(
	        'host' => '127.0.0.1',
	        'user' => 'root',
	        'password' => '',
	        'charset' => 'utf8',
	        'dbname' => '',
	        'port' => 3306
	    );
	    $config = array_merge($def_config, $config);
	    $link = @mysqli_connect($config['host'], $config['user'], $config['password'], $config['dbname'], $config['port']);
	    if (!$link) {
	        if (DB_DEBUG) {
	            exit('连接数据库失败！' . mysqli_connect_error());
	        } else {
	            exit('连接数据库失败！');
	        }
	    }
	    mysqli_set_charset($link, $config['charset']);
	    return $link;
	}
	function db_query($sql) {
	    if ($result = mysqli_query(db_init(), $sql)) {
	        return $result;
	    } else if (DB_DEBUG) {
	        echo 'SQL执行失败:<br>';
	        echo '错误的SQL为:', $sql, '<br>';
	        echo '错误的代码为:', mysqli_errno($link), '<br>';
	        echo '错误的信息为:', mysqli_error($link), '<br>';
	        exit;
	    } else {
	        exit('SQL语句执行失败。');
	    }
	}
	function db_fetch_all($sql) {
	    if ($result = db_query($sql)) {
	        $rows = array();
	        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	            $rows[] = $row;
	        }
	        mysqli_free_result($result);
	        return $rows;
	    } else {
	        return false;
	    }
	}
	function db_fetch_row($sql) {
	    if ($result = db_query($sql)) {
	        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	        return $row;
	    } else {
	        return false;
	    }
	}
	function db_fetch_column($sql) {
	    if ($result = db_query($sql)) {
	        $row = mysqli_fetch_row($result);
	        return $row[0];
	    } else {
	        return false;
	    }
	}
	function db_escape($data) {
	    return mysqli_real_escape_string(db_init(), $data);
	}
?>