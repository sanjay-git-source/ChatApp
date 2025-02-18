<?php
// Database connection (make sure to update with your own DB credentials)
$servername = "localhost";
$username = "root";  // Replace with your database username
$password = "";      // Replace with your database password
$dbname = "chat_app"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    // Return error as JSON response
    echo json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]);
    exit;
}

// Collect form data
$user_id = $_POST['user_id'];
$content = $_POST['content'];
$image = null;

// Handle image upload if there is one
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $image = $_FILES['image']['name'];
    $target_dir = "php/images/"; // Make sure you have an 'uploads' folder in your project
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // File upload successful
        $image_upload_status = "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
    } else {
        // File upload failed
        $image_upload_status = "Sorry, there was an error uploading your file.";
    }
}

// Prepare and bind the SQL statement
$stmt = $conn->prepare("INSERT INTO posts (user_id, content, image, created_at) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("iss", $user_id, $content, $image); // "i" for integer, "s" for string

// Execute the query
if ($stmt->execute()) {
    // Successful post creation
    $response = ["status" => "success", "message" => "New post created successfully!"];
} else {
    // Error in post creation
    $response = ["status" => "error", "message" => "Error: " . $stmt->error];
}

$stmt->close();
$conn->close();

// Output the response as JSON
echo json_encode($response);
?>
