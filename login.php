<?php
session_start();

// Include the database connection file
include 'database.php';

// Check if the form is submitted
if (isset($_POST['submit'])) {
  // Get the user inputs and sanitize them
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  // Query to check if the email and password match in the database
  $select = "SELECT * FROM user_table WHERE email = '$email' AND password = '$password'";
  $result = mysqli_query($conn, $select);

  // Check if there's a matching user
  if (mysqli_num_rows($result) == 1) {
    // Fetch user data
    $user_data = mysqli_fetch_assoc($result);

    // Check if the user is an admin
    if ($email === 'admin@easy.com' && $password === 'easy1234') {
      // Redirect to admin.php after successful login
      header("Location: admin.php");
      exit();
    } else {
      // Store user's email in session
      $_SESSION['email'] = $user_data['email'];

      // Redirect to home.php after successful login for regular users
      header("Location: home.php");
      exit();
    }
  } else {
    // Set error message if login fails
    $_SESSION['error'] = 'Invalid email or password!';
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>

  <!-- Latest compiled and minified CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    * {
      margin: 0;
      padding: 0;
      font-family: "Poppins", sans-serif;
    }

    body {
      margin: 0;
      padding: 0;
      background: #f8f9fa;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .card {
      border-radius: 20px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      max-width: 500px;
      width: 100%;
      display: block;
      margin: 0 auto;
    }

    .form-control {
      background-color: #ffffff;
      border-color: #ced4da;
      border-radius: 10px;
      /* Adjust the border radius as needed */
    }

    .form-label {
      font-weight: 500;
    }

    .btn-primary {
      display: block;
      margin: 0 auto;
    }


    .btn-primary:hover {
      background-color: #0069d9;
      border-color: #0062cc;
    }

    .btn-primary:focus {
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #343a40;
    }

    .login-link {
      text-align: center;
      margin-top: 20px;
    }

    .login-link a {
      color: #007bff;
      text-decoration: none;
    }

    .login-link a:hover {
      text-decoration: underline;
    }
  </style>

</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="card p-4">
          <h2 class="mb-4">Login</h2>
          <?php if (isset($_SESSION['error'])) : ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
            <?php unset($_SESSION['error']); ?>
          <?php endif; ?>
          <form method="POST">
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100" name="submit">Login</button>
          </form>
          <div class="login-link">
            Don't have an account? <a href="register.php">Register</a>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>