window.onload = function () {
	var passwordElt = document.getElementById("password");
	var pwdConfirmationElt = document.getElementById("pwdConfirmation");
	var tElt = document.getElementById("tPwdConfirmation");
	var formElt = document.getElementById("submit");
	var loginElt = document.getElementById("login");
	var usernameElt = document.getElementById("username");
	var nameElt = document.getElementById("tUsername");
	var wordElt = document.getElementById("tPassword");
	var phonenumberElt = document.getElementById("phone");
	var phoneElt = document.getElementById("tPhone");
	passwordElt.onblur = function () {
		pwdConfirmationElt.focus();
		pwdConfirmationElt.blur();
	}
	pwdConfirmationElt.onblur = function () {
		if(passwordElt.value != pwdConfirmationElt.value){
			tElt.innerHTML = "两次密码不一致！";
		}else{
			tElt.innerHTML = "";
		}
	}
	pwdConfirmationElt.onfocus = function () {
		if(passwordElt.value != pwdConfirmationElt.value){
			tElt.innerHTML = "";
		}
	}
	usernameElt.onfocus = function () {
		nameElt.innerHTML = "";
	}
	passwordElt.onfocus = function () {
		wordElt.innerHTML = "";
	}
	phonenumberElt.onfocus = function () {
		phoneElt.innerHTML = "";
	}
	loginElt.onclick = function () {
		if(tElt.innerHTML == ""){
			formElt.submit();
		}else{
			alert("两次密码不一致！");
		}
	}
}