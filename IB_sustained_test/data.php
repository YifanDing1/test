<?php
include('dbcre.php');

// Decoding the JSON data into an associative array
$data_array = json_decode(file_get_contents('php://input'), true);

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get all column names from the table and store them in an array
    $stmt = $conn->prepare("SHOW COLUMNS FROM `test_cog`");
    $stmt->execute();
    $col_names = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $col_names[] = $row['Field'];
    }

    // Retrieve the counter value from the JSON data
    $counterFromRequest = isset($data_array['counter']) ? intval($data_array['counter']) : null;
    if ($counterFromRequest === null) {
        throw new Exception("Counter value not provided");
    }

    // Update the row only if the counter matches
    $sql = "UPDATE `test_cog` SET ";
    foreach ($data_array as $key => $value) {
        if (in_array($key, $col_names) && $key != 'counter') {
            $sql .= "$key = :$key, ";
        }
    }
    $sql = rtrim($sql, ', ');
    $sql .= " WHERE counter = :counterFromRequest";

    $stmt = $conn->prepare($sql);

    // Binding values from $data_array to the prepared statement
    foreach ($data_array as $key => $value) {
        if (in_array($key, $col_names) && $key != 'counter') {
            $json_value = json_encode($value);
            $stmt->bindValue(":$key", $json_value);
        }
    }
    $stmt->bindValue(':counterFromRequest', $counterFromRequest, PDO::PARAM_INT);

    // Execute the statement
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo '{"success": true}';
    } else {
        echo '{"success": false, "message": "No rows updated, possibly due to counter mismatch"}';
    }
} catch (PDOException $e) {
    echo '{"success": false, "message": "' . $e->getMessage() . '"}';
} catch (Exception $e) {
    echo '{"success": false, "message": "' . $e->getMessage() . '"}';
}

// Closing the connection
$conn = null;
?>