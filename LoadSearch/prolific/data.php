<?php
include('../../php_include/dbcreds.php');

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, TRUE);

    if ($input) {
        $prolific_id = $input['subject_id'];
        $study_id = $input['study_id'];
        $session_id = $input['session_id'];
        $start = $input['start'];
        $subject_code = intval($input['subject_code']);

        try {
            $conn->beginTransaction();

            // Check if the prolific_id already exists in the ProlificIDs table
            $checkStmt = $conn->prepare("SELECT COUNT(*) FROM ProlificIDs WHERE prolific_id = ?");
            $checkStmt->execute([$prolific_id]);
            $count = $checkStmt->fetchColumn();

            if ($count > 0) {
                // If the prolific_id already exists, show an error message
                echo "As noted on Prolific, the task must be completed in a single attempt and restarting it is not permitted. Our records show that you already started but did not complete our task. Given that you were not able to complete it, we'd ask that you please return it in Prolific. Thank you for your understanding.";
            } else {
                // If the prolific_id doesn't exist, insert a new record
                $stmt = $conn->prepare("INSERT INTO ProlificIDs (prolific_id, subject_code, study_id, session_id, start) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$prolific_id, $subject_code, $study_id, $session_id, $start]);

                $conn->commit();
                echo "Prolific ID and Subject Code updated successfully.";
            }
        } catch (PDOException $e) {
            $conn->rollback();
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "No data received.";
    }
}
?>