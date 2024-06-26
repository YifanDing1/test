<?php
include('../php_include/dbcreds.php'); // Database connection file

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve the subject_code from the URL parameter
    $subjectCode = $_GET['subject_code'];

    // Prepare the SQL statement to retrieve the taskStarted value for the subject
    $stmt = $conn->prepare("SELECT taskStarted FROM `ProlificIDs` WHERE subject_code = :subjectCode");
    $stmt->bindValue(":subjectCode", $subjectCode);

    // Execute the statement
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $taskStarted = $result['taskStarted'];

        if ($taskStarted !== 1) {
            // Update the taskStarted value to 1 in the database
            $updateStmt = $conn->prepare("UPDATE `ProlificIDs` SET taskStarted = 1 WHERE subject_code = :subjectCode");
            $updateStmt->bindValue(":subjectCode", $subjectCode);
            $updateStmt->execute();

            // Send a response indicating that the subject can proceed
            header('Content-Type: application/json');
            echo json_encode(['taskStarted' => 0]);
        } else {
            // Send a response indicating that the subject should be redirected
            header('Content-Type: application/json');
            echo json_encode(['taskStarted' => 1]);
        }
    } else {
        // Subject not found in the database
        http_response_code(404); // Set the status code to 404 (Not Found)
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Subject not found']);
    }
} catch (PDOException $e) {
    http_response_code(500); // Set the status code to 500 (Internal Server Error)
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500); // Set the status code to 500 (Internal Server Error)
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

// Closing the connection
$conn = null;
?>