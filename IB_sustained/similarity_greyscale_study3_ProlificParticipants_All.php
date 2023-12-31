<?php

include('php_include/dbcreds.php');

//Create connection
$connection = mysqli_connect($servername, $username, $password, $dbname);
//Check connection
if ($connection === false) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error($connection);
  }

//Request data from the experiment file
$workerID = $_POST['workerID'];
$studyName = $_POST['studyName'];
$startTime = $_POST['start1'];
$timeSpent = (int)$_POST['duration3'];

$query = "INSERT INTO ProlificParticipants_All (workerID, studyName, startTime, timeSpent) VALUES (?,?,?,?)";


$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, 'sssi', $workerID, $studyName, $startTime, $timeSpent);

$result = mysqli_stmt_execute($stmt);

if($result === false) {
    die('Error : '. mysqli_errno($connection) . ": " . mysqli_error($connection));
}

echo "As noted in the task requirements on Prolific, for this study the browser needed to be Chrome or Firefox <br>";
echo "and the browser window with the study needed to remain in focus throughout the task.<br><br>";
echo "The program detected that you either were not using Chrome/Firefox, or different browser window or application <br>";
echo "became the primary one during the task (for example, you may have clicked on a different browser tab).<br>";
echo "Because that happened, the study ended before you completed it.<br><br>";
echo "Thank you for your understanding.";

mysqli_close($connection);

?>