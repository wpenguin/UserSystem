<?php
	header('content-type:text/html;charset=utf-8');
	function makePageHtml($page, $max_page) {
	    $params = $_GET;
	    unset($params['page']);
	    $params = http_build_query($params);
	    if ($params) {
	        $params .= '&';
	    }
	    $next_page = $page + 1;
	    if ($next_page > $max_page) {
	      $next_page = $max_page;
	    }
	    $prev_page = $page - 1;
	    if ($prev_page < 1 ) {
	        $prev_page  = 1;
	    }
	    $page_html = '<a href="?' . $params . 'page=1">首页</a>&nbsp;';
	    $page_html .= '<a href="?' . $params . 'page=' . $prev_page . '">上一页</a>&nbsp;';
	    $page_html .= '<a href="?' . $params . 'page=' . $next_page . '">下一页</a>&nbsp;';
	    $page_html .= '<a href="?' . $params . 'page=' . $max_page . '">尾页</a>&nbsp;';
	    return $page_html;
	}
?>