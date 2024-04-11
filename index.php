<?php
session_start();

// Check if the user clicked on logout
if (isset($_GET['logout'])) {
  // Destroy the session
  session_destroy();
  // Redirect to home.php
  header("Location: home.php");
  exit();
}

// Get the logged-in username from the session if available
$username = isset($_SESSION['email']) ? $_SESSION['email'] : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EASY Shop</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Ionicons -->
  <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    * {
      margin: 0;
      padding: 0;
      font-family: "Poppins", sans-serif;
    }

    .d-flex a {
      color: black;
      background: none;
      border: none;
      outline: none;
      box-shadow: none;
    }

    .icon-large {
      font-size: 20px;
    }

    .logged-in {
      color: black;
      background: none;
      border: none;
      outline: none;
      box-shadow: none;
    }

    .logged-in ion-icon {
      color: black;
    }

    .logged-in ion-icon:hover {
      color: #0056b3;
    }

    .logged-in.dropdown-toggle::after {
      content: "";
      display: inline-block;
      width: 0;
      height: 0;
      vertical-align: middle;
    }

    .logged-in.dropdown-toggle:hover {
      color: #0056b3;
    }


    /* Navbar */
    .navbar-expand-sm {
      background-color: #007bff;
    }

    .navbar-nav .nav-link {
      color: white !important;
      margin-right: 50px;
    }

    #carouselExampleIndicators {
      margin-top: 20px;
    }

    .carousel-item img {
      height: 500px;
      object-fit: cover;
    }

    .carousel-control-prev,
    .carousel-control-next {
      width: 5%;
    }

    .carousel-indicators {
      bottom: -40px;
    }

    .carousel-indicators button {
      background-color: #ccc;
    }

    .carousel-indicators button.active {
      background-color: #007bff;
    }

    .user-email {
      font-size: 12px;
    }

    /* Category Section */
    .section-title {
      text-align: center;
      margin-top: 50px;
    }

    .category-card {
      text-align: center;
      margin-bottom: 20px;
    }

    /* Product */
    .product-card {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 20px;
      transition: transform 0.3s ease;
      height: 300px;
      margin-bottom: 50px;
      position: relative;
    }


    .product-card:hover {
      transform: translateY(-5px);
      border: 1px solid #007bff;
      box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
    }

    .product-card img {
      height: 150px;
      object-fit: cover;
      width: 100%;
    }

    .product-card h4 {
      margin-top: 10px;
      font-size: 15px;
      font-weight: 400;
      height: 56px;
      overflow: hidden;
      margin-bottom: 20px;
    }

    .product-card p {
      font-size: 16px;
      color: #888;
      margin-bottom: 15px;
    }

    .product-card p.price {
      font-weight: bold;
      color: #007bff;
      margin-top: 50px;
    }

    .product-card a.btn {
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 20px;
      padding: 10px 20px;
      text-decoration: none;
      transition: background-color 0.3s ease;
      display: block;
      width: 100%;
      position: absolute;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
    }

    .product-card a.btn:hover {
      background-color: #0056b3;
    }

    /* Footer styling */
    .footer {
      background-color: #f8f9fa;
      color: #495057;
      font-size: 14px;
    }

    .footer h5 {
      color: #007bff;
      font-size: 18px;
      margin-bottom: 15px;
    }

    .footer p {
      margin-bottom: 15px;
    }

    .footer hr {
      border-top-color: #ddd;
    }

    .footer ul li {
      margin-bottom: 10px;
    }

    .footer ul li a {
      color: #495057;
    }

    .footer ul li a:hover {
      color: #007bff;
    }

    .footer .list-inline-item {
      margin-right: 10px;
    }

    .footer .list-inline-item:last-child {
      margin-right: 0;
    }

    .footer ion-icon {
      font-size: 20px;
      color: #007bff;
    }

    .footer ion-icon:hover {
      color: #0056b3;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="assets/images/logo.jpg" alt="ShopEasy" height="40">
      </a>
      <!-- Search form -->
      <form class="d-flex mx-auto" action="search.php" method="GET">
        <input class="form-control me-2 search-input" type="search" placeholder="Search" aria-label="Search" name="query">
        <button class="btn btn-outline-primary" type="submit">
          <ion-icon name="search"></ion-icon>
        </button>
      </form>

      <!-- Right-hand side items -->
      <div class="d-flex">
        <?php if (isset($_SESSION['email'])) { ?>
          <!-- Display cart link if user is logged in -->
          <a href="cart.php" class="btn btn-link icon-large" type="button">
            <ion-icon name="cart"></ion-icon>
          </a>
          <!-- Display user dropdown menu if logged in -->
          <div class="dropdown login">
            <button class="btn icon-large dropdown-toggle logged-in" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              <ion-icon name="person"></ion-icon>
            </button>
            <ul class="dropdown-menu" style="left: -90px;" aria-labelledby="dropdownMenuButton">
              <li><a class="dropdown-item"><?php echo $_SESSION['email']; ?></a></li>
              <li><a class="dropdown-item" href="home.php?logout=true">Logout</a></li>
            </ul>
          </div>
        <?php } else { ?>
          <!-- Display cart icon with login prompt if user is not logged in -->
          <a href="#" class="btn btn-link icon-large" type="button" onclick="promptLogin()">
            <ion-icon name="cart"></ion-icon>
          </a>
          <!-- Display login link if user is not logged in -->
          <a href="login.php" class="btn btn-link icon-large" type="button">
            <ion-icon name="person"></ion-icon>
          </a>
        <?php } ?>
      </div>
      <!-- End Right-hand side items -->

      <script>
        function promptLogin() {
          // Prompt the user to log in
          alert("Please log in to access the shopping cart.");
          // You can redirect the user to the login page if needed
          // window.location.href = "login.php";
        }

        function checkLoggedIn() {
          // Check if the user is logged in, if not, prompt them to log in
          <?php if (!isset($_SESSION['email'])) { ?>
            promptLogin();
          <?php } ?>
        }
      </script>
    </div>
  </nav>
  <!-- End Navbar -->


  <nav class="navbar navbar-expand-sm justify-content-center">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="shopAll.php">Shop All</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Categories</a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="electronics.php">Electronics</a></li>
          <li><a class="dropdown-item" href="fashion.php">Fashion</a></li>
          <li><a class="dropdown-item" href="home&kitchen.php">Home & Kitchen</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact Us</a>
      </li>
    </ul>
  </nav>


  <!-- Page Content -->
  <div class="container">
    <!-- Promotion Area - Image Slider -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="assets/images/slide-3.jpg" class="d-block w-100" alt="Slide 1">
        </div>
        <div class="carousel-item">
          <img src="assets/images/slide-2.jpg" class="d-block w-100" alt="Slide 2">
        </div>
        <div class="carousel-item">
          <img src="assets/images/slide-1.jpg" class="d-block w-100" alt="Slide 3">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <!-- Category Section -->
    <div class="row mt-4">
      <h2 class="section-title">Categories</h2>
      <div class="row">
        <?php
        // Connect to MySQL database
        @include 'database.php';

        // Check connection
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch categories from the database
        $sql = "SELECT * FROM categories_table";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          // Loop through each category and display it
          while ($row = mysqli_fetch_assoc($result)) {
            // Check if category_id is equal to 1
            if ($row['category_id'] == 1) {
              // If category_id is 1, link to electronics.php
              $category_link = 'electronics.php';
            } else if ($row['category_id'] == 2) {
              $category_link = 'fashion.php';
            } else if ($row['category_id'] == 3) {
              $category_link = 'home&kitchen.php';
            } else {
              // Otherwise, link to category.php with the respective category_id
              echo "No category found";
            }
        ?>
            <div class="col-md-4">
              <div class="category-card">
                <img src="<?php echo $row['image']; ?>" class="img-fluid" alt="<?php echo $row['name']; ?>">
                <h4><?php echo $row['name']; ?></h4>
                <p><?php echo $row['description']; ?></p>
                <!-- Set the href attribute to the determined category link -->
                <a href="<?php echo $category_link; ?>" class="btn btn-outline-dark">Shop Now</a>
              </div>
            </div>
        <?php
          }
        } else {
          echo "No categories found";
        }

        // Close database connection
        mysqli_close($conn);
        ?>
      </div>
    </div>
    <!-- End Category Section -->


    <!-- Product Section -->
    <div class="row mt-4">
      <h2 class="section-title">Products</h2>
      <div class="row row-cols-1 row-cols-md-3 row-cols-lg-6">
        <?php
        @include 'database.php';
        // Fetch products from the database
        $sql = "SELECT * FROM products_table";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          // Loop through each product and display it
          while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="col">
              <!-- Link each product card to product_details.php with product ID as parameter -->
              <a href="product_details.php?id=<?php echo $row['product_id']; ?>" style="text-decoration: none;">
                <div class="product-card">
                  <img src="<?php echo $row['image1']; ?>" class="img-fluid" alt="<?php echo $row['name']; ?>">
                  <h4><?php echo $row['name']; ?></h4>
                  <p>RM<?php echo $row['price']; ?></p>
                </div>
              </a>
            </div>
        <?php
          }
        } else {
          echo "No products found";
        }
        ?>
      </div>
    </div>
    <!-- End Product Section -->

  </div>
  <!-- End Page Content -->

  <!-- Footer -->
  <footer class="footer mt-auto py-3 bg-light">
    <div class="container">
      <div class="row">
        <!-- About Us -->
        <div class="col-md-4">
          <h5>About Us</h5>
          <p>Welcome to EasyShop, your one-stop destination for all your shopping needs. We are dedicated to providing you with the very best of products, with an emphasis on quality, affordability, and customer satisfaction.</p>
        </div>
        <!-- Contact Us -->
        <div class="col-md-4">
          <h5>Contact Us</h5>
          <p>Email: info@shopeasy.com<br>Phone: +1234567890<br>Address: 123 Street, City, Country</p>
        </div>
        <!-- Useful Links -->
        <div class="col-md-4">
          <h5>Useful Links</h5>
          <ul class="list-unstyled">
            <li><a href="#">FAQs</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms of Service</a></li>
          </ul>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <p>&copy; 2024 EasyShop. All rights reserved.</p>
        </div>
        <div class="col-md-6 text-end">
          <ul class="list-unstyled list-inline">
            <li class="list-inline-item"><a href="#"><ion-icon name="logo-facebook"></ion-icon></a></li>
            <li class="list-inline-item"><a href="#"><ion-icon name="logo-twitter"></ion-icon></a></li>
            <li class="list-inline-item"><a href="#"><ion-icon name="logo-instagram"></ion-icon></a></li>
            <li class="list-inline-item"><a href="#"><ion-icon name="logo-linkedin"></ion-icon></a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  <!-- End Footer -->


  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

  <script src="https://cdn.botpress.cloud/webchat/v1/inject.js"></script>
  <script>
    window.botpressWebChat.init({
      "composerPlaceholder": "Chat with EZ Bot",
      "botConversationDescription": "This chatbot was built surprisingly fast with Botpress",
      "botId": "d16d885d-c1b9-40d0-b7bd-ce9e40e7c4d7",
      "hostUrl": "https://cdn.botpress.cloud/webchat/v1",
      "messagingUrl": "https://messaging.botpress.cloud",
      "clientId": "d16d885d-c1b9-40d0-b7bd-ce9e40e7c4d7",
      "webhookId": "15622056-9685-4cce-8ef4-ba6abb03dbaf",
      "lazySocket": true,
      "themeName": "prism",
      "botName": "EZ Bot",
      "frontendVersion": "v1",
      "theme": "prism",
      "themeColor": "#2563eb"
    });
  </script>
</body>

</html>