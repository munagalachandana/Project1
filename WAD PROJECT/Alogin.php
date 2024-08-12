<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Alogin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #8EC5FC;
            background-image: linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%);
            margin: 0;
            padding: 0;
        }

        .box1 {
            background-color: #ffffff;
            width: 400px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .box1 h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333333;
        }

        .box2 {
            display: flex;
            flex-direction: column;
        }

        #in0, #in1, #in2, #in3, #in4, #in5 {
            margin-bottom: 15px;
            display:flex;
        }
i{
    padding-right:1rem;
    padding-top:0.5rem;
}
        input[type="text"], input[type="email"], input[type="password"] {
            width: calc(100% - 30px);
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
        }

        .butt {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            color: #ffffff;
            cursor: pointer;
        }

        .butt:hover {
            background-color: #0056b3;
        }

        .alert {
            margin-top: 15px;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .signup-link {
            text-align: center;
            margin-top: 10px;
        }

        .signup-link a {
            color: #007bff;
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php
// Database credentials (replace with your actual values)
$servername = 'localhost';
$username = 'root';
$dbpassword = '';
$dbname = 'wadproject';

// Create connection (procedural style)
$conn = mysqli_connect($servername, $username, $dbpassword, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["submit"])) {
  $email = $_POST["email"];
  $passwd = $_POST["pass"];
  $errors = 0; // No function used for error count

  if (empty($email) OR empty($passwd)) {
    echo "<script>alert('Please fill all fields');</script>";
    $errors++; // Increment a variable for error handling (no function used)
  }

  if ($errors == 0) {
    $sql = "SELECT email, password FROM admindetails WHERE email = '$email'"; // Regular query (not prepared statement)

    $result = mysqli_query($conn, $sql);

    if ($result) { // Check if query execution succeeded
      if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($passwd === $row['password']) { // Direct password comparison (not secure)
          // Login successful! Redirect to homepage
          header("Location: Ahome.php"); // Replace with your homepage URL
          exit();
        } else {
          echo "<script>alert('Incorrect password!');</script>";
        }
      } else {
        echo "<script>alert('Email not found!');</script>";
      }
    } else {
      // Handle query execution error using error messages or logging
      // (no function used for error handling)
      $errorMessage = "Query failed: " . mysqli_error($conn);
      echo "<script>alert('$errorMessage');</script>"; // Display error message (less secure)
    }
  }
}

mysqli_close($conn); // Close connection
?>
<div class="box1">
    <h1>Login</h1>
    <form action="Alogin.php" method="post">
        <section class="box2">
            <div id="in2">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" class="emailt" placeholder="Email" name="email">
            </div>
            <div id="in3">
                <i class="fa-solid fa-lock"></i>
                <input type="password" class="passwordt1" placeholder="Password" name="pass">
            </div>
            <div id="in5">
                <input type="submit" value="Login" name="submit" class="butt">
            </div>
        </section>
    </form>
</div>
</body>
</html>