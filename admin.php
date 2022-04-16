<?php

	session_start();
	
	include 'includes/db.php';
	
	if (isset($_SESSION['loggedin']) == false){
		header("Location: index.php");
		
	}	
	else if (!(isset($_SESSION['priviledge']) == 'admin')){
		header("Location: dashboard.php");
		
	}
	
?>
<!doctype html>
<html lang="en">
  <head>
  <script>document.getElementsByTagName("html")[0].className += " js";</script>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<script src="https://kit.fontawesome.com/a26e0633fc.js" crossorigin="anonymous"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#4285f4">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	

	<link rel="stylesheet" href="styles/admin.css"/>
	<link href="styles/common.css" rel="stylesheet">
	
		 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="jquery.ui.autocomplete.scroll.min.js"></script>
	
	<link rel="preload" as="image" href="images/source.gif">
	
	
    <title>Admin</title>
	<link rel="icon" type="image/x-icon" href="favicon_io/favicon.ico">
	<style>
		@import url('https://fonts.googleapis.com/css?family=Montserrat:600&display=swap');
		@import url('https://fonts.googleapis.com/css2?family=PT+Serif&display=swap');
	</style>

  </head>
  <body>
		<!--<nav class="navbar navbar-expand-lg navbar-light sticky-top link bg-light" id="myNavBar">
  <?php 
    
    //include("includes/nav.php");
    
    ?>
</nav>-->


<div id="mySidenav" class="sidenav">
  <div href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</div>
  <div id="add">Add Record</div>
  <div id="update">Update Record</div>
  <div id="view">View Record</div>
  <div id="search">Search Record</div>
  <div id="delete">Delete Record</div>
  <div id="log-out">Log Out</div>
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="#"><h4><span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
</h4></a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#"><h4>Admin</h4></a>
    </li>
  </ul>
  <ul class="navbar-nav right-al">
    <li class="nav-item active"><a  class="nav-link" href="#"><h4><?php //echo $_SESSION['entry'] ?></h4></a></li>
  </ul>
</nav>


<div class="error"></div>

<!-- Add Record -->

<div id="add-c-1">
	<div class="centres search">
		
		<div class="row">
			<div class="form-group">
				<label for="exampleInputEmail1">Search Student by entry number:</label>
				<input type="text" class="form-control" id="add-entry" aria-describedby="emailHelp" placeholder="Search for Student">
			</div>


			<div class="form-group .search-button">
				<button type="button" class="btn btn-outline-secondary" id="submit-add">Search</button>
			</div>

		</div>

	</div>
</div>



<div id="add-c-2">
	<div class="container-fluid" id="add_record">
		<div class="row">
			<div class="row">
				<div>
						<div class="form-group">
							<label for="exampleInputEmail1">Amount:</label>
							<input type="text" class="form-control" id="amount" aria-describedby="emailHelp" placeholder="Amount">
						</div>
						

						<div>
							<label for="pet-select">Semester:</label>
				
							<select name="pets" id="sem-select">
								<!--
								<option value="">Semester 1</option>
								<option value="">Semester 2</option>
								<option value="">Semester 3</option>
								<option value="">Semester 4</option>
								<option value="">Semester 5</option>
								<option value="">Semester 6</option>
								<option value="">Semester 7</option>
								<option value="">Semester 8</option>
								-->
								<?php
									$entry = $_SESSION['entry'];
									$query = "SELECT * FROM sessions";
								
									$row = mysqli_query($link,$query);
									
									if($row){
										$counter = 1;
										while($row_prod= mysqli_fetch_array($row)){
											
											$session = $row_prod['session'];

											echo '
												<option value="'.$session.'">'.$session.'</option>
											';
											
											$counter = $counter + 1;
										}
										
									} else {
										echo "error";
									}
								
								?>
							</select>
						</div>



						<div class="form-group">
							<label for="exampleInputEmail1">Transaction ID:</label>
							<input type="text" class="form-control" id="trans_id" placeholder="Transaction ID">
						</div>



						<div>
							<label for="start">Start date:</label>
			
							<input type="date" id="date" name="trip-start" value="2022-04-15"  min="2010-04-15" max="2099-04-15">

						</div>



						<div class="form-group">
							<label for="exampleInputEmail1">Bank:</label>
							<input type="text" class="form-control" id="bank" aria-describedby="emailHelp" placeholder="Bank">
						</div>



						<div class="form-group">
							<label for="exampleFormControlFile1">Transaction Receipt:</label>
							<input type="file" class="form-control-file" id="receipt">
						</div>

						<div class="form-group">
							<span class="icon-input-btn">
							<span class="glyphicon glyphicon-search">
							</span> 
							<input type="submit" id="submit" class="btn btn-primary btn-lg" value="Submit">
							</span> 
						</div>

				</div>



			</div>
		</div>
	</div>

</div>

<div id="update-c-1">
	<div class="centres search">
		
		<div class="row">
			<div class="form-group">
				<label for="exampleInputEmail1">Search Student by entry number: </label>
				<input type="text" class="form-control" id="update-entry" aria-describedby="emailHelp" placeholder="Search for Student">

			</div>

			<div class="form-group .search-button">
				<button type="button" class="btn btn-outline-secondary" id="submit-update">Search</button>
			</div>

			

		</div>

	</div>
</div>
<div id="update-c-2">

</div>

<div id="view-c-1">
	<div class="centres search">
		
		<div class="row">
			<div class="form-group">
				<label for="exampleInputEmail1">Search by semester: </label>
				<!--<input type="text" class="form-control" id="view-entry" aria-describedby="emailHelp" placeholder="Search for Student">-->
				<label for="sem-select">Semester:</label>
	
				<select name="pets" id="sem-select">
					<!--
					<option value="">Semester 1</option>
					<option value="">Semester 2</option>
					<option value="">Semester 3</option>
					<option value="">Semester 4</option>
					<option value="">Semester 5</option>
					<option value="">Semester 6</option>
					<option value="">Semester 7</option>
					<option value="">Semester 8</option>
					-->
					<?php
						$query = "SELECT * FROM sessions";
					
						$row = mysqli_query($link,$query);
						
						if($row){
							while($row_prod= mysqli_fetch_array($row)){
								
								$session = $row_prod['session'];

								echo '
									<option value="'.$session.'">'.$session.'</option>
								';
							}
							
						} else {
							echo "error";
						}
					
					?>
				</select>
			</div>
			<div class="form-group">
				<span class="icon-input-btn">
				<span class="glyphicon glyphicon-search">
				</span> 
				<input type="submit" class="btn btn-primary btn-lg" value="Search" id="submit-view">
				</span> 
			</div>
			
		</div>

	</div>
</div>
<div id="view-c-2">
	<h1>Fee Record</h1>

	<table class="table">
	  <thead>
		<tr>
		  <th scope="col">S.No.</th>
		  <th scope="col">Entry no.</th>
		  <th scope="col">Session</th>
		  <th scope="col">Amount</th>
		  <th scope="col">Transaction Date</th>
		  <th scope="col">Transaction ID</th>
		  <th scope="col">Bank Name</th>
		  <th scope="col">Receipt</th>
		</tr>
	  </thead>
	  <tbody>
	  </tbody>
	</table>
</div>
<div id="search-c-1">
	<div class="centres search">
		
		<div class="row">
			<div class="form-group">
				<label for="exampleInputEmail1">Search Student by entry number: </label>
				<input type="text" class="form-control" id="search-entry" aria-describedby="emailHelp" placeholder="Search for Student">

			</div>

			<div class="form-group .search-button">
				<button type="button" class="btn btn-outline-secondary" id="submit-search">Search</button>
			</div>

		</div>

	</div>
</div>
<div id="search-c-2">
	
</div>
<div id="delete-c-1">
	<div class="centres" class="search">
		
		<div class="row">
			<div class="form-group">
				<label for="exampleInputEmail1">Search Student by entry number: </label>
				<input type="text" class="form-control" id="delete-entry" aria-describedby="emailHelp" placeholder="Search for Student">

			</div>

			<div class="form-group .search-button">
				<button type="button" class="btn btn-outline-secondary" id="submit-delete">Search</button>
			</div>

		</div>

	</div>
</div>
<div id="delete-c-2">

</div>
	
	<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
	
<script>
$("#add").click(function(){
	$("#add-c-1").hide();
	$("#add-c-2").hide();
	$("#update-c-1").hide();
	$("#update-c-2").hide();
	$("#view-c-1").hide();
	$("#view-c-2").hide();
	$("#search-c-1").hide();
	$("#search-c-2").hide();
	$("#delete-c-1").hide();
	$("#delete-c-2").hide();
	
	$("#add-c-1").show();
	closeNav();
});


$("#view").click(function(){
	$("#add-c-1").hide();
	$("#add-c-2").hide();
	$("#update-c-1").hide();
	$("#update-c-2").hide();
	$("#view-c-1").hide();
	$("#view-c-2").hide();
	$("#search-c-1").hide();
	$("#search-c-2").hide();
	$("#delete-c-1").hide();
	$("#delete-c-2").hide();
	
	$("#view-c-1").show();
	closeNav();
});

$("#search").click(function(){
	$("#add-c-1").hide();
	$("#add-c-2").hide();
	$("#update-c-1").hide();
	$("#update-c-2").hide();
	$("#view-c-1").hide();
	$("#view-c-2").hide();
	$("#search-c-1").hide();
	$("#search-c-2").hide();
	$("#delete-c-1").hide();
	$("#delete-c-2").hide();
	
	$("#search-c-1").show();
	closeNav();
});

$("#delete").click(function(){
	$("#add-c-1").hide();
	$("#add-c-2").hide();
	$("#update-c-1").hide();
	$("#update-c-2").hide();
	$("#view-c-1").hide();
	$("#view-c-2").hide();
	$("#search-c-1").hide();
	$("#search-c-2").hide();
	$("#delete-c-1").hide();
	$("#delete-c-2").hide();
	
	$("#delete-c-1").show();
	closeNav();
});

$("#update").click(function(){
	$("#add-c-1").hide();
	$("#add-c-2").hide();
	$("#update-c-1").hide();
	$("#update-c-2").hide();
	$("#view-c-1").hide();
	$("#view-c-2").hide();
	$("#search-c-1").hide();
	$("#search-c-2").hide();
	$("#delete-c-1").hide();
	$("#delete-c-2").hide();
	
	$("#update-c-1").show();
	closeNav();
});

</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<script src="script/nav.js"></script>
	<script src="script/util.js"></script>
	<script src="script/main.js"></script>


<script>

	

	function fade_out_error_div() {
	  $(".error").fadeOut().empty();
	}
	
	var entry;
	$("#submit-add").click(function(){
		var action = 'verify_entry';
		entry = $('#add-entry').val();
		
	  $.ajax({
		type: "POST",
		url: "support/fee_user.php",
		data: { action:action, entry:entry},
		
		success:function(data){
			if (data == 'found')
			{
				$("#add-c-1").hide();
				$("#add-c-2").show();
				
			}
			else{
				
				$(".error").html('<div class="alert alert-danger" role="alert">Please Enter Valid Details</div>');
				setTimeout(fade_out_error_div, 3000);
			}
		}
	  });
	});
	
	$("#submit").click(function(){
		let files = new FormData()
		files.append('action','add_admin');
		
		files.append('session',$("#sem-select").val());
		files.append('amount',$("#amount").val());
		files.append('t_id',$("#trans_id").val());
		files.append('t_date',$("#date").val());
		files.append('bank',$("#bank").val());
		files.append('entry',entry);
		files.append('doc', $('#receipt')[0].files[0]);

		$.ajax({
			type: "POST",
			url: "support/fee_user.php",
			data: files,
			processData: false,
			contentType: false,
			success:function(data){
				console.log(data);
				if (data == "success")
				{
					$(".error").html('<div class="alert alert-success" role="alert">Successfully Submitted</div>');
				}
				else if (data == "failed")
				{
					$(".error").html('<div class="alert alert-warning" role="alert">Record already exists</div>');
				}
				else
				{
					$(".error").html('<div class="alert alert-danger" role="alert">This is an error. Please try again later</div>');
				}
				setTimeout(fade_out_error_div, 3000);
			}
		  });
		
	});
	
	
	$("#submit-search").click(function(){
		var action = 'show_details_by_entry';
		entry = $('#search-entry').val();
		
	  $.ajax({
		type: "POST",
		url: "support/fee_user.php",
		data: { action:action, entry:entry},
		
		success:function(data){
			console.log(data);
			
			$("#search-c-1").hide();
			$("#search-c-2").show();
			
			$("#search-c-2").html(data);
		}
	  });
	});
	
	$("#submit-view").click(function(){
		
		var session = $("#sem-select").val();
		var action = 'view_by_session';
		
		  $.ajax({
			type: "POST",
			url: "support/fee_user.php",
			data: { action:action, session:session},
			
			success:function(data){
				console.log(data);
				
				$("#view-c-1").hide();
				$("#view-c-2").show();
				
				$("#view-c-2").html(data);
			}
		  });
	});
	
	$("#submit-delete").click(function(){
		var action = 'show_details_by_entry_delete';
		entry = $('#delete-entry').val();
		
	  $.ajax({
		type: "POST",
		url: "support/fee_user.php",
		data: { action:action, entry:entry},
		
		success:function(data){
			console.log(data);
			
			$("#delete-c-1").hide();
			$("#delete-c-2").show();
			
			$("#delete-c-2").html(data);
		}
	  });
	});
	
	function deleteThis(session,entry)
	{
		var action = 'delete';
	
		$.ajax({
		type: "POST",
		url: "support/fee_user.php",
		data: { action:action, entry:entry,session:session},
		
		success:function(data){
			console.log(data);
			if(data == "deleted")
			{
				$(".error").html('<div class="alert alert-success" role="alert">Successfully Deleted</div>');
				setTimeout(fade_out_error_div, 3000);
				
				var action = 'show_details_by_entry_delete';
					entry = $('#delete-entry').val();
					
				  $.ajax({
					type: "POST",
					url: "support/fee_user.php",
					data: { action:action, entry:entry},
					
					success:function(data){
						console.log(data);
						
						$("#delete-c-1").hide();
						$("#delete-c-2").show();
						
						$("#delete-c-2").html(data);
					}
				  });
			}
			else
			{
				$(".error").html('<div class="alert alert-danger" role="alert">This is an error. Please try again later</div>');
				setTimeout(fade_out_error_div, 3000);
			}
		}
	  });
	}
	
	$("#submit-update").click(function(){
		var action = 'show_details_by_entry_update';
		entry = $('#update-entry').val();
		
	  $.ajax({
		type: "POST",
		url: "support/fee_user.php",
		data: { action:action, entry:entry},
		
		success:function(data){
			console.log(data);

			$("#update-c-1").hide();
			$("#update-c-2").show();
			
			$("#update-c-2").html(data);

		}
	  });
	});
	
	function updateThis(session,entry)
	{
		var action = 'show_update';
	
		$.ajax({
		type: "POST",
		url: "support/fee_user.php",
		data: { action:action, entry:entry,session:session},
		
		success:function(data){
			console.log(data);
			$("#update-c-2").html(data);
		}
	  });
	}
	
	function updateFinal(session,entry)
	{
		var amount = $('#amount-u').val();
		var t_id = $('#trans_id-u').val();
		var t_date = $('#date-u').val();
		var bank = $('#bank-u').val();
		var file_p;
		
		if( document.getElementById("receipt-u").files.length == 0 ){
			console.log("no files selected");
			file_p = false;
			
			var action = 'update_no_file';
	
			$.ajax({
			type: "POST",
			url: "support/fee_user.php",
			data: { action:action, amount:amount,t_id:t_id,session:session,entry:entry,t_date:t_date,bank:bank},
			
			success:function(data){
				console.log(data);
				if(data=="updated")
				{
					$(".error").html('<div class="alert alert-success" role="alert">Successfully Updated</div>');
					setTimeout(fade_out_error_div, 3000);
				}
				else
				{
					$(".error").html('<div class="alert alert-danger" role="alert">This is an error. Please try again later</div>');
					setTimeout(fade_out_error_div, 3000);
				}
			}
		  });
		}
		else
		{
			console.log("file detected");
			file_p = true;
			
			let files = new FormData()
			files.append('action','update_with_file');
			
			files.append('session',session);
			files.append('entry',entry);
			files.append('amount',amount);
			files.append('t_id',t_id);
			files.append('t_date',t_date);
			files.append('bank',bank);
			
			files.append('doc', $('#receipt-u')[0].files[0]);

			$.ajax({
				type: "POST",
				url: "support/fee_user.php",
				data: files,
				processData: false,
				contentType: false,
				success:function(data){
					console.log(data);
					if (data == "updated")
					{
						$(".error").html('<div class="alert alert-success" role="alert">Successfully Updated</div>');
						setTimeout(fade_out_error_div, 3000);
					}
					else
					{
						$(".error").html('<div class="alert alert-danger" role="alert">This is an error. Please try again later</div>');
						setTimeout(fade_out_error_div, 3000);
					}
				}
			});
		}
	}
	$("#log-out").click(function(){
	var action = 'logout';
	
	$.ajax({
	type: "POST",
	url: "support/fee_user.php",
	data: { action:action},
	
	success:function(data){
		console.log(data);
		if(data=="success")
		{
			location.reload(true);
		}
	}
  });
});
</script>
 
  </body>
</html>