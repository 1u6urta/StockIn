<?php
session_start();
$user_id = $_SESSION['id'];
include 'database.php';

// Read the JSON data sent from JavaScript
$json_data = file_get_contents('php://input');

// Decode the JSON data into PHP associative array
$array_data = json_decode($json_data, true);

// Ensure the JSON data is decoded successfully
if ($array_data === null) {
    // JSON decoding failed
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid JSON data']);
    exit;
}

// Get the current date
$current_date = date('Y-m-d');


// Prepare and execute SQL statements to insert data into the database
try {
    // Loop through the array and insert each item into the database
    foreach ($array_data as $item) {
        $id_produit = $item['id'];
        $montant = $item['prix'];

        // Prepare the SQL statement
        $sql = "INSERT INTO commande (id_produit, id_client, date, montant) VALUES ('$id_produit', '$user_id', '$current_date', '$montant')";

        // Execute the statement
        if (!mysqli_query($conn, $sql)) {
            throw new Exception("Error: " . $sql . "<br>" . mysqli_error($conn));
        }
    }

    // If execution reaches here, all inserts were successful
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    // Handle database errors
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}

// Close connection
mysqli_close($conn);
