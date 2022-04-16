<?php

session_start();

if (isset($_SESSION['loggedin']) == true) {
	if ($_SESSION['priviledge'] == 'user') {
		header("Location: dashboard.php");
	} else {
		header("Location: admin.php");
	}
	//echo "looogged in";
}
?>
<html lang="en">

<head>
	<title>Login</title>
	<script src="https://accounts.google.com/gsi/client" async defer></script>

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<script src="https://kit.fontawesome.com/a26e0633fc.js" crossorigin="anonymous"></script>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#4285f4">
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="styles/landing_page.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<!--<meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="48000215755-1n1925tjij02ltjf9ovqdvncd8ghn3cu.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>-->
</head>

<body>
	<div class="box w3-animate-bottom">
		<div class="content ">
			<p>Fee Grid</p>
			<h2>One Stop Solution To Manage Your Fee Payments</h2>
			<!-- <button id="buttonDiv"><img src="images/google_ico.png" alt="" width="20px" height="20px"> Log in with Google</button> -->

		</div>
	</div>

	<div id="buttonDiv"></div>
	<div class="error"></div>
	<!--<div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>-->
	<script>
		function handleCredentialResponse(response) {
			//console.log("Encoded JWT ID token: " + response.credential);

			var action = 'verify';
			var token = response.credential;
			$.ajax({
				type: "POST",
				url: "support/verify.php",
				data: {
					action: action,
					token: token
				},
				success: function(data) {
					if (data == "error") {
						$('.error').html("<div class='alert alert-danger'>Error</div>");
					} else if (data == "failed") {
						//console.log("reached");
						$('.error').html("<div class='alert alert-danger'>Please Log in with iitrpr email id. Only emails of IITRPR Permitted</div>");
						setTimeout(function() {
							window.history.forward(1);
							location.reload(true);
						}, 5000);

					} else if (data == "verified") {
						location.reload(true);
					} else {
						//$('.error').html(data);
						console.log(data);
					}

				}
			});
		}

		window.onload = function() {
			google.accounts.id.initialize({
				client_id: '48000215755-1n1925tjij02ltjf9ovqdvncd8ghn3cu.apps.googleusercontent.com',
				callback: handleCredentialResponse
			});

			google.accounts.id.prompt((notification) => {
				if (notification.isNotDisplayed() || notification.isSkippedMoment()) {
					google.accounts.id.renderButton(
						document.getElementById("buttonDiv"), {
							theme: "outline",
							size: "large"
						} // customization attributes
					);
				}
			});

		}
	</script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>