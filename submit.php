<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check the CSRF token
  session_start();
  if (empty($_POST['_csrf']) || $_POST['_csrf'] !== $_SESSION['csrf_token']) {
    die('Invalid CSRF token');
  }

  // Validate the uploaded file
  if (!isset($_FILES['user_image']) || $_FILES['user_image']['error'] !== UPLOAD_ERR_OK ||
    !getimagesize($_FILES['user_image']['tmp_name']) || $_FILES['user_image']['size'] > 2 * 1024 * 1024) {
    die('Invalid file or file size exceeds the limit of 2MB.');
  }

  // Connect to the database
  $host = 'localhost';
  $db = 'your_database_name';
  $user = 'your_username';
  $password = 'your_password';

  $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Prepare the SQL statement
  $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, image_path) VALUES (:first_name, :last_name, :image_path)");

  // Bind parameters
  $stmt->bindParam(':first_name', $_POST['first_name']);
  $stmt->bindParam(':last_name', $_POST['last_name']);
  $stmt->bindParam(':image_path', $_FILES['user_image']['name']);

  // Execute the query
  if ($stmt->execute()) {
    // Move the uploaded file to a desired location
    $targetPath = 'uploads/' . $_FILES['user_image']['name'];
    move_uploaded_file($_FILES['user_image']['tmp_name'], $targetPath);

    echo 'User data saved successfully.';
  } else {
    echo 'An error occurred while saving user data.';
  }
} else {
  echo 'Invalid request.';
}