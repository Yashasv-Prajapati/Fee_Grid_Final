<?php

session_start();

include('../includes/db.php');

if ($_POST['action'] == 'add'){
	
	$session = mysqli_real_escape_string($link, $_POST['session']);
	$amount = mysqli_real_escape_string($link, $_POST['amount']);
	$trans_id = mysqli_real_escape_string($link, $_POST['t_id']);
	$trans_date = mysqli_real_escape_string($link, $_POST['t_date']);
	$bank = mysqli_real_escape_string($link, $_POST['bank']);
	
	$entry = $_SESSION['entry'];
	
	$query = "SELECT * FROM records WHERE entry='".$entry."' and session = '".$session."' LIMIT 1";
	
	$result = mysqli_query($link, $query); 
		  
	$number = mysqli_num_rows($result); 
	
	if($number == 0){
		
		if (isset($_FILES['doc']) && !empty($_FILES['doc'])) {
			
			$doc = $_FILES['doc'];
			$name = $doc['name'];
			$path = $doc['tmp_name'];
			
			$pathinfo = pathinfo("$name");
			$newName = $entry."-".$session.".".$pathinfo['extension'];
			$final_path = "documents/$newName";
			
			move_uploaded_file($path,"../documents/$name");
			rename( "../documents/$name", "../documents/$newName");
			
			$query = "INSERT INTO records(session,amount,t_id,t_date,bank,entry,file) VALUES('".$session."','".$amount."','".$trans_id."','".$trans_date."','".$bank."','".$entry."','".$final_path."')";
			
			if(!(mysqli_query($link, $query)))
			{
				echo "error";
			}
			else
			{
				echo "success";  
			}	
			
		}
		
	} else {
		echo "failed";
	}
	

	
}
if ($_POST['action'] == 'add_admin'){
	
	$session = mysqli_real_escape_string($link, $_POST['session']);
	$amount = mysqli_real_escape_string($link, $_POST['amount']);
	$trans_id = mysqli_real_escape_string($link, $_POST['t_id']);
	$trans_date = mysqli_real_escape_string($link, $_POST['t_date']);
	$bank = mysqli_real_escape_string($link, $_POST['bank']);
	$entry = mysqli_real_escape_string($link, $_POST['entry']);
	
	$query = "SELECT * FROM records WHERE entry='".$entry."' and session = '".$session."' LIMIT 1";
	
	$result = mysqli_query($link, $query); 
		  
	$number = mysqli_num_rows($result); 
	
	if($number == 0){
		
		if (isset($_FILES['doc']) && !empty($_FILES['doc'])) {
			
			$doc = $_FILES['doc'];
			$name = $doc['name'];
			$path = $doc['tmp_name'];
			
			$pathinfo = pathinfo("$name");
			$newName = $entry."-".$session.".".$pathinfo['extension'];
			$final_path = "documents/$newName";
			
			move_uploaded_file($path,"../documents/$name");
			rename( "../documents/$name", "../documents/$newName");
			
			$query = "INSERT INTO records(session,amount,t_id,t_date,bank,entry,file) VALUES('".$session."','".$amount."','".$trans_id."','".$trans_date."','".$bank."','".$entry."','".$final_path."')";
			
			if(!(mysqli_query($link, $query)))
			{
				echo "error";
			}
			else
			{
				echo "success";  
			}	
			
		}
		
	} else {
		echo "failed";
	}
	

	
}
if ($_POST['action'] == 'delete'){
	
	$session = mysqli_real_escape_string($link, $_POST['session']);
	$entry = mysqli_real_escape_string($link, $_POST['entry']);
	
	
	$query = "SELECT * FROM records WHERE entry='".$entry."' and session = '".$session."' LIMIT 1";
	
	$row = mysqli_query($link,$query);
		
	if($row){
		
		while($row_prod= mysqli_fetch_array($row)){
			

			$file = $row_prod['file'];
			
			unlink('../'.$file);

		}
		
	} else {
		echo "error";
	}
	
	
	
	$query = "DELETE FROM records WHERE session = '".$session."' and entry = '".$entry."' LIMIT 1";
		
	if(!(mysqli_query($link, $query)))
	{
		echo "error";
	}
	else
	{
		/*
		$newName = $entry."-".$session.".".$pathinfo['extension'];
		
		unlink("../documents/$newName");
		*/
		echo "deleted";  
	}
	
	
}
	
if ($_POST['action'] == 'update'){
	
	$session = mysqli_real_escape_string($link, $_POST['session']);
	$amount = mysqli_real_escape_string($link, $_POST['amount']);
	$trans_id = mysqli_real_escape_string($link, $_POST['t_id']);
	$trans_date = mysqli_real_escape_string($link, $_POST['t_date']);
	$bank = mysqli_real_escape_string($link, $_POST['bank']);
	
	$entry = $_SESSION['entry'];
	
	if (isset($_FILES['doc']) && !empty($_FILES['doc'])) {
		
		$doc = $_FILES['doc'];
		$name = $doc['name'];
		$path = $doc['tmp_name'];
		
		$pathinfo = pathinfo("$name");
		$newName = $entry."-".$session.".".$pathinfo['extension'];
		$final_path = "documents/$newName1";
		
		unlink("../documents/$newName");
		move_uploaded_file($path,"../documents/$name");
		rename( "../documents/$name", "../documents/$newName");
		
		$query = "INSERT INTO records(session,amount,t_id,t_date,bank,entry,file) VALUES('".$session."','".$amount."','".$trans_id."','".$trans_date."','".$bank."','".$entry."','".$final_path."')";
		
		if(!(mysqli_query($link, $query)))
		{
			echo "error";
		}
		else
		{
			echo "updated";  
		}	
		
	}
	
}
	
if ($_POST['action'] == 'search'){
	
	$session = mysqli_real_escape_string($link, $_POST['session']);
	$amount = mysqli_real_escape_string($link, $_POST['amount']);
	$trans_id = mysqli_real_escape_string($link, $_POST['t_id']);
	$trans_date = mysqli_real_escape_string($link, $_POST['t_date']);
	$bank = mysqli_real_escape_string($link, $_POST['bank']);
	
	$entry = $_SESSION['entry'];
	
	if (isset($_FILES['doc']) && !empty($_FILES['doc'])) {
		
		$doc = $_FILES['doc'];
		$name = $doc['name'];
		$path = $doc['tmp_name'];
		
		$pathinfo = pathinfo("$name");
		$newName = $entry."-".$session.".".$pathinfo['extension'];
		$final_path = "documents/$newName1";
		
		unlink("../documents/$newName");
		move_uploaded_file($path,"../documents/$name");
		rename( "../documents/$name", "../documents/$newName");
		
		$query = "INSERT INTO records(session,amount,t_id,t_date,bank,entry,file) VALUES('".$session."','".$amount."','".$trans_id."','".$trans_date."','".$bank."','".$entry."','".$final_path."')";
		
		if(!(mysqli_query($link, $query)))
		{
			echo "error";
		}
		else
		{
			echo "updated";  
		}	
		
	}
	
}
if ($_POST['action'] == 'show_details_by_entry'){
	
	$entry = mysqli_real_escape_string($link, $_POST['entry']);
	
	$query = "SELECT * FROM records WHERE entry='".$entry."'";
	
	$row = mysqli_query($link,$query);
	
	$counter = 1;
	
	if($row){
		
		while($row_prod= mysqli_fetch_array($row)){
			
			$session = $row_prod['session'];
			$amount = $row_prod['amount'];
			$t_id = $row_prod['t_id'];
			$t_date = $row_prod['t_date'];
			$bank = $row_prod['bank'];
			$entry = $row_prod['entry'];
			$file = $row_prod['file'];
			
			//echo "found,,,$session,,,$amount,,,$t_id,,,$t_date,,,$bank,,,$file ../.";
			
			echo '
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
		
		<tr>
		
		  <th scope="row">'.$counter.'</th>
		  <td>'.$session.'</td>
		  <td>'.$amount.'</td>
		  <td>'.$t_date.'</td>
		  <td>'.$t_id.'</td>
		  <td>'.$bank.'</td>
		  <td><a href="'.$file.'" target="_blank">Link</a></td>
		</tr>
		
	
	  </tbody>
	</table>
			
			';
		$counter = $counter + 1;
		}
		
	} else {
		echo "error";
	}

}
if ($_POST['action'] == 'verify_entry'){
	
	$entry = mysqli_real_escape_string($link, $_POST['entry']);
	
	$query = "SELECT * FROM info";
	
	$row = mysqli_query($link, $query); 
		  
	$flag = false;
	
	if($row){
		
		while($row_prod= mysqli_fetch_array($row)){
			
			$email = $row_prod['email'];

			$entryx = substr($email,0,11);//2021csb1072
			
			if($entryx == $entry)
			{
				$flag = true;
				break;
			}
			
		}
		if($flag == false)
		{
			echo "failed";
		}
		else
		{
			echo "found";
		}
		
	} else {
		echo "error";
	}

}
if ($_POST['action'] == 'view_by_session'){
	
	$session = mysqli_real_escape_string($link, $_POST['session']);
	
	$query = "SELECT * FROM records WHERE session='".$session."'";
	
	$row = mysqli_query($link,$query);
	
	$counter = 1;
	
	echo '
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
	';
	
	if($row){
		
		while($row_prod= mysqli_fetch_array($row)){
			
			$session = $row_prod['session'];
			$amount = $row_prod['amount'];
			$t_id = $row_prod['t_id'];
			$t_date = $row_prod['t_date'];
			$bank = $row_prod['bank'];
			$entry = $row_prod['entry'];
			$file = $row_prod['file'];
			
			//echo "found,,,$session,,,$amount,,,$t_id,,,$t_date,,,$bank,,,$file ../.";
			
			echo '
				
					
					<tr>
					
					  <th scope="row">'.$counter.'</th>
					  <td>'.$entry.'</td>
					  <td>'.$session.'</td>
					  <td>'.$amount.'</td>
					  <td>'.$t_date.'</td>
					  <td>'.$t_id.'</td>
					  <td>'.$bank.'</td>
					  <td><a href="'.$file.'" target="_blank">Link</a></td>
					</tr>
					
				
				 
			
			';
			$counter = $counter + 1;
		}
		
		echo '
		 </tbody>
				</table>
		';
		
	} else {
		echo "error";
	}

}

if ($_POST['action'] == 'show_details_by_entry_delete'){
	
	$entry = mysqli_real_escape_string($link, $_POST['entry']);
	
	$query = "SELECT * FROM records WHERE entry='".$entry."'";
	
	$row = mysqli_query($link,$query);
	
	$counter = 1;
	
	if($row){
		
		while($row_prod= mysqli_fetch_array($row)){
			
			$session = $row_prod['session'];
			$amount = $row_prod['amount'];
			$t_id = $row_prod['t_id'];
			$t_date = $row_prod['t_date'];
			$bank = $row_prod['bank'];
			$entry = $row_prod['entry'];
			$file = $row_prod['file'];
			
			//echo "found,,,$session,,,$amount,,,$t_id,,,$t_date,,,$bank,,,$file ../.";
			
			echo '
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
		  <th scope="col">Delete</th>
		</tr>
	  </thead>
	  <tbody>
		
		<tr>
		
		  <th scope="row">'.$counter.'</th>
		  <td>'.$session.'</td>
		  <td>'.$amount.'</td>
		  <td>'.$t_date.'</td>
		  <td>'.$t_id.'</td>
		  <td>'.$bank.'</td>
		  <td><a href="'.$file.'" target="_blank">Link</a></td>
		  <td><button type="button" class="btn btn-primary" onclick="deleteThis(\''.$session.'\',\''.$entry.'\')"><i class="fa-solid fa-xmark"></i>Delete</button></td>
		</tr>
		
	
	  </tbody>
	</table>
			
			';
		$counter = $counter + 1;
		}
		
	} else {
		echo "error";
	}

}


if ($_POST['action'] == 'show_details_by_entry_update'){
	
	$entry = mysqli_real_escape_string($link, $_POST['entry']);
	
	$query = "SELECT * FROM records WHERE entry='".$entry."'";
	
	$row = mysqli_query($link,$query);
	
	$counter = 1;
	
	if($row){
		
		while($row_prod= mysqli_fetch_array($row)){
			
			$session = $row_prod['session'];
			$amount = $row_prod['amount'];
			$t_id = $row_prod['t_id'];
			$t_date = $row_prod['t_date'];
			$bank = $row_prod['bank'];
			$entry = $row_prod['entry'];
			$file = $row_prod['file'];
			
			//echo "found,,,$session,,,$amount,,,$t_id,,,$t_date,,,$bank,,,$file ../.";
			
			echo '
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
		  <th scope="col">Delete</th>
		</tr>
	  </thead>
	  <tbody>
		
		<tr>
		
		  <th scope="row">'.$counter.'</th>
		  <td>'.$session.'</td>
		  <td>'.$amount.'</td>
		  <td>'.$t_date.'</td>
		  <td>'.$t_id.'</td>
		  <td>'.$bank.'</td>
		  <td><a href="'.$file.'" target="_blank">Link</a></td>
		  <td><button type="button" class="btn btn-primary" onclick="updateThis(\''.$session.'\',\''.$entry.'\')"><i class="fa-solid fa-xmark"></i>Update</button></td>
		</tr>
		
	
	  </tbody>
	</table>
			
			';
		$counter = $counter + 1;
		}
		
	} else {
		echo "error";
	}

}

if ($_POST['action'] == 'show_update'){
	
	$entry = mysqli_real_escape_string($link, $_POST['entry']);
	$session = mysqli_real_escape_string($link, $_POST['session']);
	
	$query = "SELECT * FROM records WHERE entry='".$entry."' and session='".$session."'";
	
	$row = mysqli_query($link,$query);
		
	if($row){
		
		while($row_prod= mysqli_fetch_array($row)){
			
			$session = $row_prod['session'];
			$amount = $row_prod['amount'];
			$t_id = $row_prod['t_id'];
			$t_date = $row_prod['t_date'];
			$bank = $row_prod['bank'];
			$entry = $row_prod['entry'];
			$file = $row_prod['file'];
			
			//echo "found,,,$session,,,$amount,,,$t_id,,,$t_date,,,$bank,,,$file ../.";
			
			echo '
				<div class="container-fluid" id="update_record">
		<div class="row">
			<div class="row">
				<div>
						<div class="form-group">
							<label for="exampleInputEmail1">Amount:</label>
							<input type="text" class="form-control" id="amount-u" aria-describedby="emailHelp" placeholder="Amount" value="'.$amount.'">
						</div>



						<div class="form-group">
							<label for="exampleInputEmail1">Transaction ID:</label>
							<input type="text" class="form-control" id="trans_id-u" placeholder="Transaction ID" value="'.$t_id.'">
						</div>



						<div>
							<label for="start">Start date:</label>
			
							<input type="date" id="date-u" name="trip-start" value="2022-04-15"  min="2010-04-15" max="2099-04-15" value="'.$t_date.'">

						</div>



						<div class="form-group">
							<label for="exampleInputEmail1">Bank:</label>
							<input type="text" class="form-control" id="bank-u" aria-describedby="emailHelp" placeholder="Bank" value="'.$bank.'">
						</div>



						<div class="form-group">
							<label for="exampleFormControlFile1">Transaction Receipt:</label>
							<input type="file" class="form-control-file" id="receipt-u">
						</div>

						<div class="form-group">
							<span class="icon-input-btn">
							<span class="glyphicon glyphicon-search">
							</span> 
							<button type="submit" id="submit-u" class="btn btn-primary btn-lg" value="Update" onclick="updateFinal(\''.$session.'\',\''.$entry.'\')">Update</button>
							</span> 
						</div>

				</div>



			</div>
		</div>
	</div>
			
			';
		}
		
	} else {
		echo "error";
	}

}

if ($_POST['action'] == 'update_no_file'){
	
	$entry = mysqli_real_escape_string($link, $_POST['entry']);
	$session = mysqli_real_escape_string($link, $_POST['session']);
	$amount = mysqli_real_escape_string($link, $_POST['amount']);
	$trans_id = mysqli_real_escape_string($link, $_POST['t_id']);
	$trans_date = mysqli_real_escape_string($link, $_POST['t_date']);
	$bank = mysqli_real_escape_string($link, $_POST['bank']);
	
	$query = "UPDATE records SET amount='".$amount."', t_id='".$trans_id."', t_date='".$trans_date."', bank='".$bank."' WHERE entry='".$entry."' and session='".$session."'";
	
		
	if(!(mysqli_query($link, $query)))
	{
		echo "error";
	}
	else
	{
		echo "updated";  
	}

}

if ($_POST['action'] == 'update_with_file'){
	
	$session = mysqli_real_escape_string($link, $_POST['session']);
	$amount = mysqli_real_escape_string($link, $_POST['amount']);
	$trans_id = mysqli_real_escape_string($link, $_POST['t_id']);
	$trans_date = mysqli_real_escape_string($link, $_POST['t_date']);
	$bank = mysqli_real_escape_string($link, $_POST['bank']);
	$entry = mysqli_real_escape_string($link, $_POST['entry']);
	
	if (isset($_FILES['doc']) && !empty($_FILES['doc'])) {
		
		$doc = $_FILES['doc'];
		$name = $doc['name'];
		$path = $doc['tmp_name'];
		
		$pathinfo = pathinfo("$name");
		$newName = $entry."-".$session.".".$pathinfo['extension'];
		$final_path = "documents/$newName";
		
		unlink("../documents/$newName");
		move_uploaded_file($path,"../documents/$name");
		rename( "../documents/$name", "../documents/$newName");
		
		$query = "UPDATE records SET amount='".$amount."', t_id='".$trans_id."', t_date='".$trans_date."', bank='".$bank."' WHERE entry='".$entry."' and session='".$session."'";		
		
		if(!(mysqli_query($link, $query)))
		{
			echo "error";
		}
		else
		{
			echo "updated";  
		}	
		
	}
}	
if ($_POST['action'] == 'logout'){
	unset($_SESSION['loggedin']);
	echo "success";
}
?>