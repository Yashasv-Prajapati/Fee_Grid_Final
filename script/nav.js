var prevScrollpos = window.pageYOffset;
		window.onscroll = function() {
		var currentScrollPos = window.pageYOffset;
		  if (prevScrollpos > currentScrollPos) {
			document.getElementById("myNavBar").style.top = "0";
		  } else {
			document.getElementById("myNavBar").style.top = "-500px";
		  }
		  prevScrollpos = currentScrollPos;
		}
		


	

	$(window).load(function() {		
		$(".se-pre-con").fadeOut("slow");;
	});
	

