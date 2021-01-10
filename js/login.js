window.onload = function () {
	var usernameElt = document.getElementById("username");
	var passwordElt = document.getElementById("password");
	var codesElt = document.getElementById("code");
	var nameElt = document.getElementById("tUsername");
	var wordElt = document.getElementById("tPassword");
	var codeElt = document.getElementById("tCode");
	var change = document.getElementById("change");
	var img = document.getElementById("code_img");
	usernameElt.onfocus = function () {
		nameElt.innerHTML = "";
	}
	passwordElt.onfocus = function () {
		wordElt.innerHTML = "";
	}
	codesElt.onfocus = function () {
		codeElt.innerHTML = "";
	}
	change.onclick = function(){
		img.src = "verification_code.php?t="+Math.random();
		return false;
	}
}