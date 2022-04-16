<?php

	session_start();
	
	include 'includes/db.php';

	
	if (isset($_SESSION['loggedin']) == false){
		header("Location: index.php");
		
	}	
	else if (!(isset($_SESSION['priviledge']) == 'user')){
		header("Location: admin.php");
		
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
	

	<link rel="stylesheet" href="styles/Dashboard.css"/>
	<link href="styles/common.css" rel="stylesheet">
	
		 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="jquery.ui.autocomplete.scroll.min.js"></script>
	
	<link rel="preload" as="image" href="images/source.gif">
	
	
    <title>Dashboard</title>
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
  <div id="record">Fee Record</div>
  <div id="log-out">Log Out</div>
</div>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="#"><h4><span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
</h4></a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="index.php"><h4>Fee Grid</h4></a>
    </li>
  </ul>
  <ul class="navbar-nav right-al">
    <li class="nav-item active"><a  class="nav-link" href="#"><h4><?php echo $_SESSION['entry'] ?></h4></a></li>
  </ul>
</nav>

<div class="error"></div>
<div id="add-c">
	
	<div class="container" id="add_record">
		<div class="row">
			<div class="row">
				<div>
					<div class="heading">Add Record</div>
					<div class="form-ad">
						<div class="form-group">
							<label for="exampleInputEmail1">Amount:</label>
							<input type="text" class="form-control" id="amount" aria-describedby="emailHelp" placeholder="Amount">
						</div>
						

						<div>
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
							<label for="start">Date:</label>
			
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

</div>


<div id="record-c">
		<h1>Fee Record</h1>

	<table class="table">
	  <thead>
		<tr>
		  <th scope="col">S.No.</th>
		  <th scope="col">Session</th>
		  <th scope="col">Amount</th>
		  <th scope="col">Transaction Date</th>
		  <th scope="col">Transaction ID</th>
		  <th scope="col">Bank Name</th>
		  <th scope="col">Receipt</th>
		</tr>
	  </thead>
	  <tbody>
		<?php
		
			$entry = $_SESSION['entry'];
			$query = "SELECT * FROM records WHERE entry='$entry'";
		
			$row = mysqli_query($link,$query);
			
			if($row){
				$counter = 1;
				while($row_prod= mysqli_fetch_array($row)){
					
					$session = $row_prod['session'];
					$amount = $row_prod['amount'];
					$t_id = $row_prod['t_id'];
					$t_date = $row_prod['t_date'];
					$bank = $row_prod['bank'];
					$entry = $row_prod['entry'];
					$file = $row_prod['file'];
					
					echo '
					<tr>
						<th scope="row">'.$counter.'</th>
						<td>'.$session.'</td>
						<td>'.$amount.'</td>
						<td>'.$t_id.'</td>
						<td>'.$t_date.'</td>
						<td>'.$bank.'</td>
						<td><a href="'.$file.'" target="_blank">File</a></td>
					</tr>
					';
					
					$counter = $counter + 1;
				}
				
			} else {
				echo "error";
			}
		
		
		?>
	  </tbody>
	</table>
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
	$("#add-c").show();
	$("#record-c").hide();
	closeNav();
});

$("#record").click(function(){
	$("#add-c").hide();
	$("#record-c").show();
	closeNav();
});

function fade_out_error_div() {
	  $(".error").fadeOut().empty();
	}
	
</script>

<script>

$("#submit").click(function(){
	let files = new FormData()
	files.append('action','add');
	
	files.append('session',$("#sem-select").val());
	files.append('amount',$("#amount").val());
	files.append('t_id',$("#trans_id").val());
	files.append('t_date',$("#date").val());
	files.append('bank',$("#bank").val());
	
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

	
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<script src="script/nav.js"></script>
	<script src="script/util.js"></script>
	<script src="script/main.js"></script>
	
 
  </body>
</html>