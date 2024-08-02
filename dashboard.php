<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();

}

// Connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loginsh";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT firstname, lastname, email, country FROM register WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($firstname, $lastname, $email, $country);
$stmt->fetch();

$stmt->close();
$conn->close();
?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>my dashboard</title>
  <link href="style.css" rel="stylesheet" type="text/css" />
  <script src="script.js" defer></script>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  
</head>


<body>
  <header1>
  <div class="logo">
    <p>SC</p>
  </div>

  <nav>

    <ul class="sidebar">
      <li class="sideitem" onclick=hideSidebar()><svg xmlns="http://www.w3.org/2000/svg" width="35" height="45"
          viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);cursor:pointer;transform: ;msFilter:;">
          <path
            d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z">
          </path>
        </svg></li>
      <li class="sideitem"><a href="index.html">Home</a></li>
      <li class="sideitem"><a href="resources.html">Resources</a></li>
      <li class="sideitem"><a href="blogs.html">Blogs</a></li>
      

    </ul>

    <ul class="navbar-list">
      <li class="navbaritem"><a href="index.html">Home</a></li>

      <li class="navbaritem"><a href="resources.html">Resources</a>
        <ul class="submenu">
          <li class="sideitem"><a href="test.html">University Tests</a></li>
          <li class="sideitem"><a href="scholarships.html">Scholarships</a></li>
          <li class="sideitem"><a href="internships.html">Internships</a></li>
      </li>
    </ul>

    <li class="navbaritem"><a href="blogs.html">Blogs</a></li>

    </ul>
  </nav>


  <button class="butcta"><a class="cta" href="dashboard.html">Account</a></button>
  <button class="i" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="40"
        viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
        <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path>
      </svg></a></button>

</header1>

  <div class="title">
    <h1  class="test-heading">My Profile</h1>
  </div>

 <section class="home">
   <table class="aboutme">
     <tr>
       <td><b>First Name: </b></td>
       <td><?php echo htmlspecialchars($firstname); ?></td>
       </tr>
     <tr>
        <td><b>Last Name:</b></td>
        <td><?php echo htmlspecialchars($lastname); ?></td>
        </tr>
     <tr>
        <td><b>Country:</b></td>
        <td><?php echo htmlspecialchars($country); ?></td>
        </tr>
     <tr>
        <td><b>Email:</b></td>
        <td><?php echo htmlspecialchars($email); ?></td>
        </tr>
     
   </table>
 </section>

  
  <section class="create-blog">
    <form action="submit-post.php" method="post">
    <div class="blogcreate">
      <div>
      Create New Blog Post
        </div>
      <textarea type="text" class="blg" name="title" placeholder="Blog Title"></textarea>
      <textarea class="content" name="content" placeholder="Content" id="blogcontent"></textarea>
<input type="hidden" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>">
      <button class="blogsubmit" type="submit">Submit</button>
      
      </div>
      </form>
  </section>

 <style>
.sch{
   margin:auto;
   padding:5px 10px;
   border-radius:12px;
   margin-top:1em;
}
.int{
   margin:auto;
   padding:5px 10px;
   border-radius:12px;
   margin-top:1em;
}

/* __________________________________________________________
CREATE BLOG
*/

.create-blog{
   text-align:center;
   color:#FDFCD4;
   background-color:#380e0b;
   padding:40px;
   margin:auto;
   justify-content:center;
   display:block;
}
.create-blog div{
   font-size:40px;
}

.blogcreate{
   padding:20px;
   margin:auto;
   justify-content:center;
   display:block;
 
}
.blg{
   padding:10px;
   width:75%;
   text-align:center;
   background-color:#FDFCD4;
   margin-top:1em;
}
.content{
   padding:5px;
   width:75%;
   text-align:center;
   background-color:#FDFCD4;
   height:100px;
   margin-top:2em;
   resize:none;
   width: 100%;
   box-sizing: border-box;
   font-size: 16px;
   line-height: 1.5;
   overflow: hidden;

}

.blogsubmit{
   padding: 8px 15px;
   background-color: #C78E3A;
   border-radius:30px;
   color:#FDFCD4;
   width:30%;
   margin-top:1em;
}
.blogsubmit:hover{
   color:black;
   cursor:pointer;
}

</style>

 <button class="ctn"><a href="logout.php">Logout</a></button>
</body>
</html> 