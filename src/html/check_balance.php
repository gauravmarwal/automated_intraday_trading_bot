<?php
$conn = new mysqli("localhost", "root", "", "be_project");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
// $_POST['amount']=1000;

	
	$sql = "SELECT balance FROM user_details WHERE user_name= 'simran1999'";
	$amount = mysqli_query($conn, $sql);


	$fetchAllData = array();
	$fetchAllData = $amount->fetch_row();
	echo $fetchAllData[0];
	

	
?>