<link rel="stylesheet" href="./css/index.css" />
<div id="top">
	<div id="top_head">
		<div id="top_head_box">
			<?php if($login): ?>
				<ul>
					<li>
						<span class="a" style="color: #000;">当前用户:"<?php echo $userinfo['username']; ?>"</span>
						<span class="l">|</span>
						<a href="index.php?userpage=1" class="a" id="user">用户管理</a>
						<span class="l">|</span>
						<a href="" class="a">忘记密码</a>
						<span class="l">|</span>
						<a href="" class="a">修改密码</a>
						<span class="l">|</span>
						<a class="a" href="?action=logout">退出</a>
					</li>
				</ul>
			<?php else: ?>
				<ul>
					<li>
						<a href="login.php" class="a" id="logining">你好，请登录</a>
						<span class="l">|</span>
						<a href="regist.php" style="color: #E1251B;" class="a">立即注册</a>
					</li>
				</ul>
			<?php endIf; ?>
		</div>
	</div>
</div>
