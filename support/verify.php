<?php

session_start();

include('../includes/db.php');

require_once '../vendor/autoload.php';

if ($_POST['action'] == 'verify'){
	
	$id_token = $_POST['token'];
	$CLIENT_ID ='48000215755-1n1925tjij02ltjf9ovqdvncd8ghn3cu.apps.googleusercontent.com';
	
	$client = new Google_Client(['client_id' => $CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
	$payload = $client->verifyIdToken($id_token);
	if ($payload) {
	  $userid = $payload['sub'];
	  //echo $userid;
	  //print_r($payload);
	  
	  $email = $payload['email'];
	  $verification = $payload['email_verified'];
	  $name = $payload['name'];
	  $picture = $payload['picture'];
	  
	  $entry = substr($email,0,11);//2021csb1072
	  $year = substr($email,0,4); //2021
	  $substr2 = substr($email,-12);//iitrpr.ac.in
	  $length = strlen($email);//24
	  
	  if($verification)
	  {
		  //echo "verified";
		  $query = "SELECT * FROM info WHERE email = '".$email."'";
		  
		  $result = mysqli_query($link, $query); 
		  
		  $number = mysqli_num_rows($result);  
		  
		  if ($number == 0)
		  {
			  if(($substr2 == 'iitrpr.ac.in') && ($length == 24))
			  {
			  $email = mysqli_real_escape_string($link, $email);
			  $name = mysqli_real_escape_string($link, $name);
			  $picture = mysqli_real_escape_string($link, $picture);
			  $query = "INSERT INTO info(email,name,photo,priviledge,year) VALUES('".$email."','".$name."','".$picture."','user','".$year."')";
			  
			  if(!(mysqli_query($link, $query)))
			  {
				  echo "error";
			  }
			  else
			  {
				echo "verified";  
			  }
			  $_SESSION['priviledge'] = 'user';
			  $_SESSION['entry'] = $entry;
			  $_SESSION['id'] = mysqli_insert_id($link);
			  $_SESSION["loggedin"] = true;/*
			  header("Location: ../Dashboard.php");
			  */
			  }
			  else
			  {
				  echo "failed";
			  }
		  }
		  else if($number == 1)
		  {
			  echo "verified";
			  
			  
			  while($row_prod= mysqli_fetch_array($result)){
				  $priv = $row_prod['priviledge'];
				  $name = $row_prod['name'];
			  }
			  if($priv == 'user')
			  {
				  $_SESSION['priviledge'] = 'user';
				  $_SESSION['entry'] = $entry;
				  $_SESSION['id'] = mysqli_insert_id($link);
				  $_SESSION["loggedin"] = true;/*
				  header("Location: ../Dashboard.php");
				  */
			  }
			  else
			  {
				  $_SESSION['name'] = $name;
				  $_SESSION['priviledge'] = 'admin';
				  $_SESSION['entry'] = $entry;
				  $_SESSION['id'] = mysqli_insert_id($link);
				  $_SESSION["loggedin"] = true;
			  }
		  }
		  else
		  {
			  echo "error";
		  }
		  
	  }
	  else
	  {
		  echo "failed";
	  }
	  // If request specified a G Suite domain:
	  //$domain = $payload['hd'];
	} else {
	  // Invalid ID token
	  echo "error";
	}
	
}

?>