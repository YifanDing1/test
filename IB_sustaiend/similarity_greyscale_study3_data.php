<?php

include('php_include/dbcreds.php');

//Create connection
$connection = mysqli_connect($servername, $username, $password, $dbname);
//Check connection
if ($connection === false) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error($connection);
  }

//Request data from the experiment file
$study = $_POST['studyName'];
$workerID = $_POST['workerID'];
$start = $_POST['start'];
$end = $_POST['end'];
$total_time_spent = (int)$_POST['duration'];
$browser = $_POST['browserType'];
$t1_bounces = $_POST['t1_bounces'];
$t2_bounces = $_POST['t2_bounces'];
$t3_bounces = $_POST['t3_bounces'];
$t1_counts = (int)$_POST['t1_counts'];
$t2_counts = (int)$_POST['t2_counts'];
$t3_counts = (int)$_POST['t3_counts'];
$attended_color = $_POST['attended_color'];
$ignored_color = $_POST['ignored_color'];
$ib_type = $_POST['ib_type'];
$resp_color = $_POST['resp_ib_color'];
$resp_shape = $_POST['resp_ib_shape'];
$noticed_ib = $_POST['noticed_ib'];
$age = $_POST['age_resp'];
$country = $_POST['country_resp'];
$no_problems = $_POST['no_problems'];
$stuttering = $_POST['stuttering'];
$freezing = $_POST['freezing'];
$other_issues = $_POST['other_issues'];
$other_text = $_POST['other_text'];
$normal_vision = $_POST['normal_vis'];
$trial_1_acc = $_POST['trial_1_acc'];
$trial_2_acc = $_POST['trial_2_acc'];
$trial_3_acc = $_POST['trial_3_acc'];
$trial_12_acc = $_POST['trial_12_acc'];
$trial_123_acc = $_POST['trial_123_acc'];
$prior = $_POST['prior_resp'];
$prior_text = $_POST['prior_text'];
$attended_hex = $_POST['attended_hex'];
$ignored_hex = $_POST['ignored_hex'];
$unexpected_hex = $_POST['unexpected_hex'];
$background_hex = $_POST['background_hex'];
$trial_duration_ms = (int)$_POST['trialDuration'];

$studyName = $_POST['studyName'];
$startTime = $_POST['start'];
$timeSpent = $_POST['duration'];

$query = "INSERT INTO similarity_greyscale_dataAll (study, workerID, start, end, total_time_spent, browser, t1_bounces, t2_bounces, t3_bounces, t1_counts, t2_counts,
    t3_counts, attended_color, ignored_color, ib_type, resp_color, resp_shape, noticed_ib, age,
    country, no_problems, stuttering, freezing, other_issues, other_text, normal_vision, trial_1_acc, trial_2_acc, trial_3_acc, trial_12_acc, trial_123_acc, prior, prior_text,
    attended_hex, ignored_hex, unexpected_hex, background_hex, trial_duration_ms)
	VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, 'ssssisiiiiiissssssisiiiisiiiiiiisssssi', $study, $workerID, $start, $end, $total_time_spent, $browser, $t1_bounces, $t2_bounces, $t3_bounces, $t1_counts, $t2_counts, $t3_counts,
	$attended_color, $ignored_color, $ib_type, $resp_color, $resp_shape, $noticed_ib, $age, $country, $no_problems,
	$stuttering, $freezing, $other_issues, $other_text,$normal_vision, $trial_1_acc, $trial_2_acc, $trial_3_acc, $trial_12_acc, $trial_123_acc, $prior, $prior_text,
	$attended_hex, $ignored_hex, $unexpected_hex, $background_hex, $trial_duration_ms);

$query1 = "INSERT INTO ProlificParticipants_All (workerID, studyName, startTime, timeSpent) VALUES (?,?,?,?)";
$stmt1 = mysqli_prepare($connection, $query1);
mysqli_stmt_bind_param($stmt1, 'sssi', $workerID, $studyName, $startTime, $timeSpent);

mysqli_stmt_execute($stmt1);
$result = mysqli_stmt_execute($stmt);

if($result === false) {
    die('Error : '. mysqli_errno($connection) . ": " . mysqli_error($connection));
}

mysqli_close($connection);
header("Location: https://app.prolific.co/submissions/complete?cc=3CB990A7")
?>