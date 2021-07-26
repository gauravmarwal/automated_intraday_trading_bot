<?php

$conn = new mysqli("localhost", "root", "", "be_project");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
// $_POST['amount']=1000;
// echo '<script>alert("The amount is "+$amount)</script>';
$uname="simran1999";
if (isset( $_POST["add_money"])){
	$added_money=$_POST["added_money"];
	
	$sql = "SELECT balance FROM user_details WHERE user_name= '$uname'";
	$amount = mysqli_query($conn, $sql);


	$fetchAllData = array();
	$fetchAllData = $amount->fetch_row();
	$final_amount= $fetchAllData[0]+$added_money;
	$insert_query="UPDATE user_details set balance='$final_amount' where user_name='$uname'";
	$insert_status = mysqli_query($conn, $insert_query);
	
	echo '<script>alert("Amount added.")</script>';;
	
}

if (isset( $_POST["withdraw_money"])){
	$withdrawed_money=$_POST["withdrawed_money"];
	
	$sql = "SELECT balance FROM user_details WHERE user_name= '$uname'";
	$amount = mysqli_query($conn, $sql);


	$fetchAllData = array();
	$fetchAllData = $amount->fetch_row();
	if ($withdrawed_money>$fetchAllData[0]) {
		
		echo '<script>alert("Amount entered is more than your wallet amount.")</script>';
	}
	else {
	$final_amount= $fetchAllData[0]-$withdrawed_money;
	$insert_query="UPDATE user_details set balance='$final_amount' where user_name='$uname'";
	$insert_status = mysqli_query($conn, $insert_query);
	
	echo '<script>alert("Amount Withdrawn.")</script>';;
	
}
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>E-wallet</title>
	<link rel="stylesheet" href="E-wallet.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script>
$(document).ready(function() {
  $.ajax({
    url: 'check_balance.php',
    
    success: function(data) {
      $('#amt').html("₹ "+data);
    }
  });
});
</script>
	<style>
				body {
			background-color: #ffffff !important;
			zoom: 170%;

		  
		}

		.wallet-container {
			background: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6)),url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTjOvSperRYjHH9-EHlKZJBfwvXy4rJpyerzHQsnp8DuuycYU5_);
				width: 320px;
				color: #fff;
				font-size: 15px;
				padding: 20px 20px 0;
				top: 55%;
				left: 50%;
				transform: translate(-50%,-50%);
				position: absolute;
		  
		  
		}

		.page-title {
			text-align: left;
		}

		.fa-user {
			float: right;
		}

		.fa-align-left {
			margin-right: 15px;
		}

		.amount-box img {
			width: 50px;
		}

		.amount {
			font-size: 35px;
		}

		.amount-box p {
			margin-top: 10px;
			margin-bottom: -10px;
		}

		.btn-group {
			margin: 20px 0;
		}

		.btn-group .btn {
			margin: 8px;
			border-radius: 20px !important;
			font-size: 12px;
		}

		.txn-history {
			text-align: left;
		}

		.txn-list {
			background-color: #fff;
			padding: 12px 10px; 
			color: #777;
			font-size: 14px;
			margin: 7px 0;
		}

		.debit-amount {
			color: red;
			float: right;
		}

		.credit-amount {
			color: green;
			float: right;

		}

		.footer-menu {
			margin: 20px -20px 0;
			bottom: 0;
			border-top: 1px solid #ccc;
			padding: 10px 10px 0;
		}

		.footer-menu p {
			font-size: 12px;
		}

		@media screen and (max-width: 800px){
		  .wallet-container {
		    height: 115%;
		    bottom: 20px;
		    margin-top: 100px;
		  }
		  
		}
	</style>
</head>
<body>

	<div class="wallet-container text-center" id="main_div">
		<p class="page-title"></p>
		<a href="index.php" style="text-decoration: none; color: white;">home</a>
		<div class="amount-box text-center">
			<img src="https://lh3.googleusercontent.com/ohLHGNvMvQjOcmRpL4rjS3YQlcpO0D_80jJpJ-QA7-fQln9p3n7BAnqu3mxQ6kI4Sw" alt="wallet">
			<p>Total Balance</p>
			<p class="amount" id="amt"></p>
		</div>

		<div class="btn-group text-center">
			<button type="button" class="btn btn-outline-light" name="add_money1" onclick="show_add()">Add Money</button>
			<button type="button" class="btn btn-outline-light" name="Withdraw_money1" onclick="show_with()">Widthdraw</button>
			</div>
	</div>


	<div class="wallet-container text-center" style="display: none;" id="Add_div">
		<p class="page-title">Add Money</p>

		<div class="amount-box text-center" >
			<img src="https://lh3.googleusercontent.com/ohLHGNvMvQjOcmRpL4rjS3YQlcpO0D_80jJpJ-QA7-fQln9p3n7BAnqu3mxQ6kI4Sw" alt="wallet">
			<p>Enter Amount to add</p><br><br>
			<form action="my-balance.php" method="post">
				<input type="number" name="added_money" required>
				<div class="btn-group text-center">
				<button type="submit" class="btn btn-outline-light" name="add_money" onclick="disable_add()">Add Money</button>
				</div>
			</form>
		</div>
	</div>

		<div class="wallet-container text-center" style="display: none;" id="With_div">
		<p class="page-title">Withdraw Money</p>

		<div class="amount-box text-center">
			<img src="https://lh3.googleusercontent.com/ohLHGNvMvQjOcmRpL4rjS3YQlcpO0D_80jJpJ-QA7-fQln9p3n7BAnqu3mxQ6kI4Sw" alt="wallet">
			<p>Enter Amount to Withdraw</p><br><br>
			<form action="my-balance.php" method="post">
				<input type="number" name="withdrawed_money" required>
				<div class="btn-group text-center">
				<button type="submit" class="btn btn-outline-light" name="withdraw_money" onclick="disable_with()">Withdraw Money</button>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript">
		function show_add() {
   document.getElementById('Add_div').style.display = "block";
   document.getElementById('main_div').style.display = "none";
}
function disable_add() {
	if (document.getElementByName('added_money')!="") {
	document.getElementById('added_money')="";
   document.getElementById('Add_div').style.display = "none";
document.getElementById('main_div').style.display = "block";
}
}
function show_with() {
   document.getElementById('With_div').style.display = "block";
   document.getElementById('main_div').style.display = "none";

}
function disable_with() {
	if (document.getElementByName('withdrawed_money')!="") {
		document.getElementById('withdrawed_money')="";
   document.getElementById('With_div').style.display = "none";
document.getElementById('main_div').style.display = "block";
}
}
	</script>
</body>
</html>