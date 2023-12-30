<?php

include('php_include/dbcreds.php');

//Create connection
$connection = mysqli_connect($servername, $username, $password, $dbname);
//Check connection
if ($connection === false) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error($connection);
  }

$query = "SELECT COUNT(*) FROM ProlificParticipants_All";

$result = mysqli_query($connection, $query);

$num = mysqli_fetch_assoc($result);

$workerID = $_REQUEST["workerId"];

$idQueryall = "SELECT COUNT(*) FROM ProlificParticipants_All WHERE workerID = '$workerID'";

$inelall_result = mysqli_query($connection, $idQueryall);

$ineligibleall = mysqli_fetch_assoc($inelall_result);

echo $num['COUNT(*)'].",".$workerID.",".$ineligiblecurr['COUNT(*)'].",".$ineligibleall['COUNT(*)'];

mysqli_close($connection);
?>