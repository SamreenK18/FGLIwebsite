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

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM register WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No account found with that email.";
    }

    $stmt->close();
}

$conn->close();
?>



<!DOCTYPE html>
<html>
  <head>

    <title>YOUR NAME HERE</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- link the webpage's stylesheet -->
    <link rel="stylesheet" href="style.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- link the webpage's JavaScript file -->
    <script src="script.js" defer></script>

  </head>
  <body class="logon" align=center>
    <div class="log">
      <form action="" method="post">

        <h1>Login</h1>

                <div class="input-box">
                    <input type="text" placeholder="Email" name="email" required>
                    <i class='bx bxs-user'></i>
                </div>


                <div class="input-box">
                   <input type="text" placeholder="Password" name="password" required>
                  <i class='bx bxs-lock-alt'></i>
                </div>

                <div class="remember-forgot">
                  <label class="r"><input type="checkbox" checked="checked">Remember Me</label>
                  <a class="ar" href=#>Forgot Password?</a><br>
                </div>


        <button class="loginButton" type="submit">Login</button>

        <div class="register-link">
          <p class="rl">Don't have an account? <a href="register.php">Register</a></p>
        </div>

      </form>
    </div>
  </body>