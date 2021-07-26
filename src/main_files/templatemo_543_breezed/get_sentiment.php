<?php
$conn = new mysqli("localhost", "root", "", "be_project");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT int_i FROM logs where counter=1";
$int_i = mysqli_query($conn, $sql);


$fetchint_i = array();
$fetchint_i = $int_i->fetch_row();

$i=(int)$fetchint_i[0]+1;
// echo $i;

// echo "Connected successfully";
// $_POST['amount']=1000;
if($i==2){
echo 'started';}
elseif($i<2){
    echo "Cannot start now";
    return "Cannot start now.";
}


$sql = "SELECT logs FROM logs where counter=$i";
$amount = mysqli_query($conn, $sql);
if($amount!=FALSE){

$fetchAllData = array();
$fetchAllData = $amount->fetch_row();
$sql = "UPDATE logs SET int_i=$i where counter=1";
$result = mysqli_query($conn, $sql);
echo $fetchAllData[0];
    }
else{
    echo "nothing available!";
    }	
?>