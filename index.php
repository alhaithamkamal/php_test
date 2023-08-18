<!DOCTYPE html>
<html>
<head>
  <title>User Registration</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
      padding: 20px;
    }

    .container {
      max-width: 500px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .form-group {
      display: flex;
      flex-direction: column;
      margin-bottom: 20px;
    }

    label {
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="file"] {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    #thumbnail {
      max-width: 200px;
      max-height: 200px;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <form id="registration-form" action="submit.php" method="POST" enctype="multipart/form-data">
      <?php
        // Generate and store the CSRF token in the session
        session_start();
        $csrfToken = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $csrfToken;
      ?>
      <input type="hidden" name="_csrf" value="<?php echo $csrfToken; ?>">

      <div class="form-group">
        <label for="first-name">First Name</label>
        <input type="text" id="first-name" name="first_name" required>
      </div>

      <div class="form-group">
        <label for="last-name">Last Name</label>
        <input type="text" id="last-name" name="last_name" required>
      </div>

      <div class="form-group">
        <label for="user-image">User Image</label>
        <input type="file" id="user-image" name="user_image" accept="image/*" required>
      </div>

      <div class="form-group">
        <input type="submit" value="Submit">
      </div>

      <div id="thumbnail"></div>
    </form>
  </div>

  <script src="script.js"></script>
</body>
</html>