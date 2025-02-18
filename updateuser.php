<?php
session_start();
include_once "php/config.php"; // Include database connection file

// Check if user is logged in
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
    exit();
}

$id = $_SESSION['unique_id']; // Get user ID from session

// If form is submitted (POST request)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $url = mysqli_real_escape_string($conn, $_POST['url']);
    $pronouns = mysqli_real_escape_string($conn, $_POST['pronouns']);
    $bio = mysqli_real_escape_string($conn, $_POST['bio']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);

    // Handle profile image upload
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == 0) {
        $imageName = $_FILES['profileImage']['name'];
        $imageTmpName = $_FILES['profileImage']['tmp_name'];
        $imageSize = $_FILES['profileImage']['size'];
        $imageError = $_FILES['profileImage']['error'];
        $imageType = $_FILES['profileImage']['type'];

        // Check if image is valid (JPEG, PNG, etc.)
        $allowedTypes = ['image/jpeg', 'image/png'];
        if (in_array($imageType, $allowedTypes) && $imageSize < 5000000) {
            $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);
            $imageNewName = uniqid('', true) . "." . $imageExt;
            $imageDestination = 'php/images/' . $imageNewName;

            // Move the uploaded file to the images directory
            if (move_uploaded_file($imageTmpName, $imageDestination)) {
                // Update the database with the new image name
                $updateImageQuery = "UPDATE users SET img = ? WHERE unique_id = ?";
                $stmt = $conn->prepare($updateImageQuery);
                $stmt->bind_param("si", $imageNewName, $id);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

    // Update user details in the database
    $updateQuery = "UPDATE users SET username = ?, fname = ?, lname = ?, url = ?, pronouns = ?, bio = ?, gender = ? WHERE unique_id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sssssssi", $username, $fname, $lname, $url, $pronouns, $bio, $gender, $id);
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        echo "Profile updated successfully!";
    } else {
        echo "Failed to update profile!";
    }

    $stmt->close();
    header("Location: home.php"); // Redirect to profile page
    exit();
}

?>
