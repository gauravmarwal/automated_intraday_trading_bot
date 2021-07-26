<?php
$conn = new mysqli("localhost", "root", "", "be_project");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT sentiment FROM social_media_sentiment where company_name='ACC'";
$amount = mysqli_query($conn, $sql);
if($amount!=FALSE){

$fetchAllData = array();
$fetchAllData = $amount->fetch_row();
echo $fetchAllData[0];
    }
else{
    echo "nothing available!";
    }	
?>