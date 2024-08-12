<?php
session_start();
if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $passwd = $_POST["pass"];
    $rollnum=substr($email,0,10);
    $_SESSION['roll']=$rollnum;
    $errors=0;
    if(empty($email) OR empty($passwd)){
        echo "<script>alert('Please fill all fields');</script>";
        $errors++;
    }
    if($errors==0){
        $servername = 'localhost';
        $username = 'root';
        $dbpassword = '';
        $dbname = 'wadproject';

        $conn = new mysqli($servername, $username, $dbpassword, $dbname, 3306);

        if ($conn->connect_error) {
            die('Connection Failed: ' . $conn->connect_error);
        }

        $sql = "SELECT * FROM userdetails WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);
        if(mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                // $_SESSION['user_id']=$row['SINO'];
                if(password_verify($passwd, $row['password'])){
                    echo "<div class='alert alert-success></div>";
                    // echo $_SESSION['user_id'];
                    header("Location:home.php");
                    // Redirect to dashboard or wherever after successful login
                } else {
                    echo "<div class='alert alert-danger'>Incorrect password</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>User not found</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
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
            padding: 10rem;
            padding-top:2rem;
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
            display: flex;
            margin-top:0.5rem;
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
            padding: 3rem;
            background-color: pink;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            color: Black;
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

<div class="box1">
    <h1>Login</h1>
    <form action="login.php" method="post">
        <section class="box2">
            <div id="in2">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" class="emailt" placeholder="Email" name="email">
            </div>
            <div id="in3">
                <i class="fa-solid fa-lock"></i>
                <input type="password" class="passwordt1" placeholder="Password" name="pass">
            </div>
            <div class="field">
              <button type="submit" name="submit" >Login</button>
            </div>
        </section>
    </form>
    <div class="signup-link">
        <a href="register.php">Don't have an account? Sign up now</a>
    </div>
</div>
<!-- <script>function redirectTohomePage() {
        // Change the action attribute of the form to the login page URL
        document.querySelector('form').action = 'home.php';
        // Submit the form
        document.querySelector('form').submit();
}</script> -->
</body>
</html>