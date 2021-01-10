<?php
	$img_w=70;
	$img_h=50;
	$char_len = 5;
	$font=5;
	$char = array_merge(range('A','Z'), range('a','z'),range(1, 9));
	$rand_keys = array_rand($char, $char_len);
	if ($char_len == 1) {
		$rand_keys = array($rand_keys);
	}
	shuffle($rand_keys);
	$code = '';
	foreach($rand_keys as $key) {
		$code .= $char[$key];
	}
	session_start();
	$_SESSION['captcha_code'] = $code;
	$img = imageCreateTrueColor($img_w, $img_h);
	$bg_color = imageColorAllocate($img, 0xcc, 0xcc, 0xcc);
	imageFill($img, 0, 0, $bg_color);
	for($i=0; $i<=300; ++$i) {
		$color = imageColorAllocate($img, mt_rand(0, 255), mt_rand(0, 255),mt_rand(0, 255));
		imageSetPixel($img, mt_rand(0, $img_w), mt_rand(0, $img_h), $color);
	}
	for($i=0; $i<=10; ++$i) {
		$color = imageColorAllocate($img, mt_rand(0, 255), mt_rand(0, 255),mt_rand(0, 255));
		imageline($img, mt_rand(0, $img_w), mt_rand(0, $img_h), mt_rand(0, $img_w), mt_rand(0, $img_h),$color);
	}
	$rect_color = imageColorAllocate($img, 0x90, 0x90, 0x90);
	imageRectangle($img, 0, 0, $img_w-1, $img_h-1, $rect_color);
	$str_color = imageColorAllocate($img, mt_rand(0, 100), mt_rand(0, 100),mt_rand(0, 100));
	$font_w = imageFontWidth($font);
	$font_h = imageFontHeight($font);
	$str_w = $font_w * $char_len;
	imageString($img, $font, ($img_w-$str_w)/2, ($img_h-$font_h)/2, $code, $str_color);
	header('Content-Type: image/png');
	imagepng($img);
	imagedestroy($img);
?>