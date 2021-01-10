window.onload = function () {
	var isloginElt = document.getElementById("islogin");
	
	if(isloginElt.value == 1){
		var buttonElt = document.getElementsByClassName("li");
		var right_boxElt = document.getElementsByClassName("right_box");
		var comElt = document.getElementById("com");
		var userElt = document.getElementById("user");
		var orderElt = document.getElementById("order");
		
		function auto_block (num) {
			right_boxElt[num].style.display = 'block';
		}
		
		function auto (num) {
			buttonElt[num].onclick = function () {
				auto_none();
				auto_block(num);
			}
		}
		
		auto(0);
		auto(1);
		auto(2);
		auto(3);
		
		function auto_none () {
			for (var i = 0; i < right_boxElt.length; i++) {
				right_boxElt[i].style.display = 'none';
			}
		}
		
		comElt.onclick = function () {
			auto_none ();
			right_boxElt[1].style.display = 'block';
			return false;
		}
		
		userElt.onclick = function () {
			auto_none ();
			right_boxElt[2].style.display = 'block';
			return false;
		}
		
		orderElt.onclick = function () {
			auto_none ();
			right_boxElt[3].style.display = 'block';
			return false;
		}
	}else{
		var loginElt = document.getElementById("logining");
		var buttonElt = document.getElementsByClassName("li");
		var  right_boxElt = document.getElementsByClassName("right_box");
		function auto_none () {
			for (var i = 0; i < right_boxElt.length; i++) {
				right_boxElt[i].style.display = 'none';
			}
		}
		function auto_block (num) {
			right_boxElt[num].style.display = 'block';
		}
		
		function auto (num) {
			buttonElt[num].onclick = function () {
				auto_none();
				auto_block(num);
			}
		}
		
		auto(0);
		auto(1);
		auto(2);
		auto(3);
		auto(4);
		
		loginElt.onclick = function () {
			auto_none ();
			right_boxElt[0].style.display = 'block';
			return false;
		}
	}
	
}