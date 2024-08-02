<?php
// Connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loginsh";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $country = $_POST['country'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO register (country, firstname, lastname, password, email) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $country, $firstname, $lastname, $password, $email);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html>
  <head>

    <title>register</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- link the webpage's stylesheet -->
    <link rel="stylesheet" href="style.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- link the webpage's JavaScript file -->
    <script src="script.js" defer></script>

  </head>
  <body class="register" align=center>
    <div class="log">
      <form method="post" action="">
       
        <h1>Register</h1>

                <div class="input-box">
                    <input type="text" placeholder="First Name" name="firstname" required>
                    <i class='bx bxs-user'></i>
                </div>
        <div class="input-box">
            <input type="text" placeholder="Last Name" name="lastname" required>
            <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
            <input type="text" placeholder="Country" name="country" required>
            <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
        <input type="text" placeholder="Email" name="email" required>
        <i class='bx bxs-envelope'></i>
    </div>


                <div class="input-box">
                   <input type="text" placeholder="Password" name="password" required>
                  <i class='bx bxs-lock-alt'></i>
                </div>




        <button class="loginButton" type="submit">Create Account</button>

        <div class="register-link">
          <p class="rl">Already have an account? <a href="login.php">Login</a></p>
        </div>

      </form>
    </div>

    
  </body>
    </html>