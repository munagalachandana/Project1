<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="register.css">
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
#q{
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
</style>
</head>
<body>
<?php
if(isset($_POST["submit"])){
    $roll = $_POST["Rollnumber"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $passwd = $_POST["pass"];
    $confirmpasswd = $_POST["confirm"];
    $errors=0;
    if(empty($roll) OR empty($name) OR empty($email)OR empty($passwd) OR empty($confirmpasswd)){
        echo "<script>alert('please fill all );</script>";
        $errors++;
    }
    if (preg_match("/\s/", $name)) {
        echo "<script>alert('Name cannot contain spaces!');</script>";
        $errors++;
    }
    if(strlen($roll) != 10 || substr($email, 0, 10) !== $roll) {
        echo "<script>alert('invalid email');</script>";
        $errors++;
   }
   $validEmailLength = strlen($email);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $validEmailLength < 12 || substr($email, $validEmailLength - 12) !== "@bvrit.ac.in") {
        echo "<script>alert('Invalid email format!');</script>";
        $errors++;
    }
    // if(strlen($passwd)<8){
    //     echo "<script>alert('password must be greater than 8 characters');</script>";
    //     $errors++;
    // }
    $uppercase = preg_match("/[A-Z]/", $passwd);
    $lowercase = preg_match("/[a-z]/", $passwd);
    $digit = preg_match("/\d/", $passwd);
    $specialChars = preg_match("/\W/", $passwd); // Matches non-word characters

    if (!$uppercase || !$lowercase || !$digit || !$specialChars || strlen($passwd)<8) {
        echo "<script>alert('Password must be Strong!');</script>";
        $errors++;
    }
    if($passwd !== $confirmpasswd){
        echo "<script>alert('passwords do not match');</script>";
        $errors++;
    }
    

    if($errors==0){
        // Hash the password
        $hashed_password = password_hash($passwd, PASSWORD_DEFAULT);
        
     $servername = 'localhost';
    $username = 'root';
    $dbpassword = '';
    $dbname = 'wadproject';

    $conn = new mysqli($servername, $username, $dbpassword, $dbname, 3306);

    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }
        $sql = "INSERT INTO userdetails(rollnumber, name, email, password) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_bind_param($stmt, "ssss", $roll, $name, $email, $hashed_password);
            if(mysqli_stmt_execute($stmt)){
                echo "<div class='alert alert-success'>You are registered successfully</div>";
            }
            else{
                echo "<div class='alert alert-danger'>Error: " . mysqli_stmt_error($stmt) . "</div>";
            }
        }
        else{
            echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
?>
<div class="box1">
    <h1>Create Account</h1>
    <form action="register.php" method="post">
        <section class="box2">
            <div id="in0">
                <i class="fa-solid fa-keyboard" id="q"></i>
                <input type="text" class="numbert" placeholder="Roll Number" name="Rollnumber">
            </div>
            <div id="in1">
                <i class="fa-solid fa-user" id="q"></i>
                <input type="text" class="namet" placeholder="Name" name="name">
            </div>
            <div id="in2">
                <i class="fa-solid fa-envelope" id="q"></i>
                <input type="email" class="emailt" placeholder="Email" name="email">
            </div>
            
            <div id="in3">
                <i class="fa-solid fa-lock" id="q"></i>
                <input type="password" class="passwordt1" placeholder="Password" name="pass">
            </div>
            <div id="in4">
                <i class="fa-solid fa-lock" id="q"></i>
                <input type="password" class="passwordt2" placeholder="Confirm Password" name="confirm">
            </div>
            <div id="in5">
                <input type="submit" value="Register" name="submit" class="butt">
            </div>
        </section>
    </form>
</div>
</body>
</html>