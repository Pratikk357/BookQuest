<?php
require_once '../conn.php';
$conn = createConn();

// SQL query to count the number of items in the table
$table_name = "requested_book";
$sql = "SELECT COUNT(*) as count FROM $table_name";

// Execute the query
$result = $conn->query($sql);

if (!$result) {
    // Handle query error
    die("Query failed: " . $conn->error);
}

// Fetch the result
if ($row = $result->fetch_assoc()) {
    echo "Number of items in the table: " . $row['count'];
} else {
    echo "0 results";
}

// Free result set
$result->free();

// Close the connection
$conn->close();
?>