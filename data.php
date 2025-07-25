<?php
// Ensure no whitespace or BOM before this opening tag
header('Content-Type: application/json'); // Set header immediately for JSON response

// Database configuration
$servername = "localhost";  // Change if your MySQL server is elsewhere
$username = "root";  // Your MySQL username
$password = "";  // Your MySQL password
$dbname = "restaurant";    // Your database name

$conn = null; // Initialize connection variable

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        // If connection fails, immediately return JSON error
        echo json_encode([
            "status" => "error",
            "message" => "Database connection failed: " . $conn->connect_error
        ]);
        exit; // Exit to prevent further execution and potential HTML output
    }

    // Set charset to UTF-8
    $conn->set_charset("utf8");

    // Function to sanitize input data
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Check if form was submitted via POST and if it's an AJAX request
    if ($_SERVER["REQUEST_METHOD"] == "POST" && 
        !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        
        // Check if name field exists and is not empty
        if (isset($_POST['name']) && !empty(trim($_POST['name']))) {
            
            // Sanitize the input
            $name = sanitize_input($_POST['name']);
            
            // Prepare and execute SQL statement to only insert customer_name
            // This assumes 'order_status' and 'created_at' columns in the 'order' table
            // have default values or are nullable.
            $stmt = $conn->prepare("INSERT INTO `order` (name) VALUES (?)");
            
            if ($stmt === false) {
                // Handle prepare error
                echo json_encode([
                    "status" => "error",
                    "message" => "SQL prepare failed: " . $conn->error
                ]);
                exit;
            }

            // Bind only the name parameter (s for string)
            $stmt->bind_param("s", $name);
            
            if ($stmt->execute()) {
                $order_id = $conn->insert_id;
                echo json_encode([
                    "status" => "success",
                    "message" => "Name saved successfully!", // Changed message for clarity
                    "order_id" => $order_id,
                    "name" => $name,
                    "created_at" => date('Y-m-d H:i:s')
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Error inserting name: " . $stmt->error
                ]);
            }
            
            $stmt->close();
            
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Name field is required and cannot be empty."
            ]);
        }
    } else {
        // If not a POST request or not an AJAX request, return an error or a default message
        echo json_encode([
            "status" => "error",
            "message" => "Invalid request method or not an AJAX request."
        ]);
    }

} catch (Exception $e) {
    // Catch any unexpected PHP errors and return a JSON error
    echo json_encode([
        "status" => "error",
        "message" => "An unexpected server error occurred: " . $e->getMessage()
    ]);
} finally {
    // Close connection if it was opened
    if ($conn) {
        $conn->close();
    }
    exit; // Always exit after sending JSON response
}

// The functions getAllOrders and getTodayOrders are not used in this simplified
// script's AJAX POST handling. If you need to retrieve orders, you would
// typically create a separate endpoint or modify this script to handle GET requests
// for order retrieval.
?>
