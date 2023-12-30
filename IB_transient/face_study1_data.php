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
$workerID = $_POST['worker_id'];
$start = $_POST['start'];
$end = $_POST['end'];
$total_time_spent = (int)$_POST['duration'];
$browser = $_POST['browser'];
$actuallyLonger1 = $_POST['line_judgment_answer0'];
$actuallyLonger2 = $_POST['line_judgment_answer1'];
$actuallyLonger3 = $_POST['line_judgment_answer2'];
$actuallyLonger4_IB = $_POST['line_judgment_answer3'];
$actuallyLonger5_Divided = $_POST['line_judgment_answer4'];
$reportedLonger1 = $_POST['line_judgment0'];
$reportedLonger2 = $_POST['line_judgment1'];
$reportedLonger3 = $_POST['line_judgment2'];
$reportedLonger4_IB = $_POST['line_judgment3'];
$reportedLonger5_Divided = $_POST['line_judgment4'];
$correctLonger1 = $_POST['line_judgment_correct0'];
$correctLonger2 = $_POST['line_judgment_correct1'];
$correctLonger3 = $_POST['line_judgment_correct2'];
$correctLonger4_IB = $_POST['line_judgment_correct3'];
$correctLonger5_Divided = $_POST['line_judgment_correct4'];
$IB_trial_unexpected_object = $_POST['face_type'];
$IB_trial_noticed = $_POST['face_notice'];
$IB_trial_object_description = $_POST['id_face_survey_yes'];
$IB_trial_object_forcedChoice = $_POST['face_question'];
$IB_trial_FC_position = $_POST['faces_option_order']; //
$divided_trial_unexpected_object = $_POST['face_type'];
$divided_trial_noticed = $_POST['square_notice1'];
$divided_trial_object_description = $_POST['id_face_survey_yes1'];
$divided_trial_object_forcedChoice = $_POST['face_question1'];
$divided_trial_FC_position = $_POST['faces_option_order1']; //
$age = $_POST['id_age'];
$country = $_POST['country'];
$problems = $_POST['playback_pre'];
$problem_description = $_POST['playback'];
$normal_vision = $_POST['id_vision'];
$normal_color = $_POST['empty'];
$ishihara = $_POST['empty'];
$prior_knowledge_IB = $_POST['prior'];
$prior_knowledge_description = $_POST['prior_text'];
$duration_cross_ms = $_POST['displayDur'];
$duration_IB_stim_ms = $_POST['displayDur'];
$duration_mask_ms = $_POST['maskDur'];
$trial1_cross_location = $_POST['cross_loc0'];
$trial2_cross_location = $_POST['cross_loc1'];
$trial3_cross_location = $_POST['cross_loc2'];
$trial4_cross_location = $_POST['cross_loc3'];
$trial5_cross_location = $_POST['cross_loc4'];
$trial1_horizontal_length_px = $_POST['horizontal_length0'];
$trial1_vertical_length_px = $_POST['vertical_length0'];
$trial2_horizontal_length_px = $_POST['horizontal_length1'];
$trial2_vertical_length_px = $_POST['vertical_length1'];
$trial3_horizontal_length_px = $_POST['horizontal_length2'];
$trial3_vertical_length_px = $_POST['vertical_length2'];
$trial4_horizontal_length_px = $_POST['horizontal_length3'];
$trial4_vertical_length_px = $_POST['vertical_length3'];
$trial5_horizontal_length_px = $_POST['horizontal_length4'];
$trial5_vertical_length_px = $_POST['vertical_length4'];
$cross_distance_from_fixation_px = $_POST['cross_dist'];
$IB_stim_distance_from_fixation_px = $_POST['IB_dist'];
//
$studyName = $_POST['studyName'];
$startTime = $_POST['start'];
$timeSpent = $_POST['duration'];

$query = "INSERT INTO IB_face_data_ALL (study, workerID, start, end, total_time_spent, browser, actuallyLonger1,
actuallyLonger2, actuallyLonger3, actuallyLonger4_IB, actuallyLonger5_Divided, reportedLonger1, reportedLonger2,
reportedLonger3, reportedLonger4_IB, reportedLonger5_Divided, correctLonger1, correctLonger2, correctLonger3,
correctLonger4_IB, correctLonger5_Divided, IB_trial_unexpected_object, IB_trial_noticed, IB_trial_object_description,
IB_trial_object_forcedChoice, IB_trial_FC_position, divided_trial_unexpected_object, divided_trial_noticed, divided_trial_object_description,
divided_trial_object_forcedChoice, divided_trial_FC_position, age, country, problems, problem_description, normal_vision, normal_color, ishihara,
prior_knowledge_IB, prior_knowledge_description, duration_cross_ms, duration_IB_stim_ms, duration_mask_ms, trial1_cross_location,
trial2_cross_location, trial3_cross_location, trial4_cross_location, trial5_cross_location, trial1_horizontal_length_px,
trial1_vertical_length_px, trial2_horizontal_length_px, trial2_vertical_length_px, trial3_horizontal_length_px, trial3_vertical_length_px,
trial4_horizontal_length_px, trial4_vertical_length_px, trial5_horizontal_length_px, trial5_vertical_length_px, cross_distance_from_fixation_px,
IB_stim_distance_from_fixation_px)
	VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, 'ssssisssssssssssiiiiissssssssssssisiiiisiiisssssiiiiiiiiiiii', $study, $workerID, $start, $end, $total_time_spent, $browser,
$actuallyLonger1, $actuallyLonger2, $actuallyLonger3,$actuallyLonger4_IB, $actuallyLonger5_Divided, $reportedLonger1, $reportedLonger2,
$reportedLonger3, $reportedLonger4_IB, $reportedLonger5_Divided, $correctLonger1, $correctLonger2, $correctLonger3, $correctLonger4_IB, $correctLonger5_Divided,
$IB_trial_unexpected_object, $IB_trial_noticed, $IB_trial_object_description, $IB_trial_object_forcedChoice, $IB_trial_FC_position, $divided_trial_unexpected_object, $divided_trial_noticed,
$divided_trial_object_description, $divided_trial_object_forcedChoice, $divided_trial_FC_position, $age, $country, $problems, $problem_description, $normal_vision, $normal_color, $ishihara,
$prior_knowledge_IB, $prior_knowledge_description, $duration_cross_ms, $duration_IB_stim_ms, $duration_mask_ms, $trial1_cross_location,
$trial2_cross_location, $trial3_cross_location, $trial4_cross_location, $trial5_cross_location, $trial1_horizontal_length_px, $trial1_vertical_length_px,
$trial2_horizontal_length_px, $trial2_vertical_length_px, $trial3_horizontal_length_px, $trial3_vertical_length_px, $trial4_horizontal_length_px,
$trial4_vertical_length_px, $trial5_horizontal_length_px, $trial5_vertical_length_px, $cross_distance_from_fixation_px, $IB_stim_distance_from_fixation_px);

$query1 = "INSERT INTO ProlificParticipants_All (workerID, studyName, startTime, timeSpent) VALUES (?,?,?,?)";
$stmt1 = mysqli_prepare($connection, $query1);
mysqli_stmt_bind_param($stmt1, 'sssi', $workerID, $studyName, $startTime, $timeSpent);

mysqli_stmt_execute($stmt1);
$result = mysqli_stmt_execute($stmt);
//$result1 = mysqli_stmt_execute($stmt1);

if($result === false) {
    die('Error : '. mysqli_errno($connection) . ": " . mysqli_error($connection));
}

mysqli_close($connection);
header("Location: https://app.prolific.co/submissions/complete?cc=C12WBIK5")
?>