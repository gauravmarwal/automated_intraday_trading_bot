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
$sql = "UPDATE logs SET int_i=$i where counter=1";
$result = mysqli_query($conn, $sql);
?>