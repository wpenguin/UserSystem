<?php
	require './lib/init.lib.php';
	require 'userislogin.php';
	class visitorInfo{
	    public function getIp(){
	        $ip=false;
	        if(!empty($_SERVER["HTTP_CLIENT_IP"])){
	            $ip = $_SERVER["HTTP_CLIENT_IP"];
	        }
	        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	            $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
	            if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
	            for ($i = 0; $i < count($ips); $i++) {
	                if (!eregi ("^(10│172.16│192.168).", $ips[$i])) {
	                    $ip = $ips[$i];
	                    break;
	                }
	            }
	        }
	        return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
	    }
	    public function getFromPage(){
	        return $_SERVER['HTTP_REFERER'];
	    }
	}
    $visitor = new visitorInfo();
    $address=$visitor->getIp();
    $sql="select times from t_count where ip='$address'";
    $result = db_fetch_column($sql);
    if($result == null){
       $sql="insert into t_count(ip, times) values('$address','1')";
    }else{
        $times = $result + 1;
        $sql="update t_count set times='$times' where ip ='$address'";
    }
    $result=db_query($sql);
    $sql = "select times from t_count where ip = '$address'";
    $a = db_fetch_column($sql);
    $sql = "select count(ip) from t_count";
    $b = db_fetch_column($sql);
    $sql = "select times from t_count";
    $rrows = db_fetch_all($sql);
    $c = 0;
    foreach($rrows as $rrow){
    	$c += $rrow['times'];
    }
	if($login){
		$userinfo = $_SESSION['userinfo'];
		$id = $userinfo['id'];
		$row = db_fetch_row("select * from t_users where id = $id");
		$userpage_size = 5;
		$userres = db_query('select count(*) from t_users');
		if(!$userres){
			exit(mysqli_error());
		}
		$usercount = mysqli_fetch_row($userres);
		$usercount = $usercount[0];
		$usermax_page = ceil($usercount / $userpage_size);
		$userpage = isset($_GET['userpage']) ? intval($_GET['userpage']) : 1;
		$userpage = $userpage > $usermax_page ? $usermax_page : $userpage;
		$userpage = $userpage < 1 ? 1 : $userpage;
		$userpage_html = "<a href='./index.php?userpage=1'>首页</a>&nbsp;";
		$userpage_html .= "<a href='./index.php?userpage=" . (($userpage-1) > 0 ? ($userpage-1) : 1)."'>上一页</a>&nbsp;";
		$userpage_html .= "<a href='./index.php?userpage=" . (($userpage+1) < $usermax_page ? ($userpage+1) : $usermax_page)."'>下一页</a>&nbsp;";
		$userpage_html .= "<a href='./index.php?userpage={$usermax_page}'>尾页</a>";
		$userlim = ($userpage-1) * $userpage_size;
		$sql = "select * from t_users limit {$userlim},{$userpage_size}";
		$userres = db_fetch_all($sql);
	}
	require 'index_top.php';
	
	require './view/index.html';
		
?>