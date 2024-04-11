<?php
session_start();
@include 'database.php';

if (isset($_POST['submit'])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

  // Check if passwords match
  if ($password !== $confirm_password) {
    $_SESSION['error'] = 'Passwords do not match!';
  } else {
    $select = "SELECT * FROM user_table WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
      $_SESSION['error'] = 'User already exists!';
    } else {
      $insert = "INSERT INTO user_table (email, password) VALUES ('$email', '$password')";
      mysqli_query($conn, $insert);

      $_SESSION['success'] = 'Registration successful!';
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Page</title>

  <!-- Latest compiled and minified CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Include SweetAlert CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
          <h2 class="mb-4">Register</h2>
          <form action="#" method="POST" class="form" onsubmit="return validateForm()">
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
              <div id="passwordError" class="text-danger"></div>
            </div>
            <div class="mb-3">
              <label for="confirm_password" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
              <p id="passwordMismatchError" class="text-danger"></p>
            </div>
            <button type="submit" class="btn btn-primary w-100" name="submit">Register</button>
          </form>
          <div class="login-link">
            Already have an account? <a href="login.php">Login</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function validateForm() {
      var password = document.getElementById('password').value;
      var confirmPassword = document.getElementById('confirm_password').value;
      var passwordError = document.getElementById('passwordError');
      if (password.length < 8) {
        passwordError.innerHTML = 'Password must at least 8 characters.';
        return false;
      }
      passwordError.innerHTML = ''; // Clear previous error messages
      if (password !== confirmPassword) {
        document.getElementById('passwordMismatchError').innerHTML = 'Passwords do not match!';
        return false;
      }
      return true;
    }
  </script>

  <!-- Error Modal -->
  <div id="errorModal" class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Error</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p id="errorText"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Success Modal -->
  <div id="successModal" class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Success</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p id="successText"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    <?php if (isset($_SESSION['success'])) { ?>
      // Display success message using SweetAlert
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '<?php echo $_SESSION['success']; ?>',
        confirmButtonText: 'OK'
      }).then((result) => {
        // Redirect to login.php after a short delay
        if (result.isConfirmed) {
          setTimeout(function() {
            window.location.href = 'login.php';
          }, 1000); // Redirect after 1 second (1000 milliseconds)
        }
      });
      <?php unset($_SESSION['success']); ?>
    <?php } ?>
  </script>
</body>

</html>