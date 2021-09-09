<?php
$error=false;
include 'dbcon.php';

if($_SERVER['REQUEST_METHOD']=="POST"){
    $email =$_POST['email'];
    $password = $_POST['password'];

    $sql ="SELECT * FROM `user` WHERE `email` = '$email'";
    $result = mysqli_query($dbcon, $sql);
    $num = mysqli_num_rows($result);
    if($num==1){
        while($row=mysqli_fetch_assoc($result)){
            if(password_verify($password, $row['password'])){
                $login=true;
                session_start();
                $_SESSION['loggedin']=true;
                header("location: diary.php");
            }else{
                $error=true;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Secret Diary | Log in</title>
</head>

<body>

    <div class="container">
        <div class="form">
            <h1>Secret Diary</h1>
            <p>Store your thoughts permanently & securely.</p>
            <?php
            if($error){
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Alert!</strong> Incorrect email or password.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
            }
            ?>
            <span>Log in using your username and password</span>
            <form action="login.php" method="post">
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                        placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                        required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="check">
                    <label class="form-check-label" for="check">Stay logged in</label>
                </div>
                <button type="submit" name="submit" class="btn btn-success" id="btn">Log in</button>
            </form>
            <div class="mt-3">
                <a href="index.php" class="btn btn-outline-primary">Sign up</a>
            </div>
        </div>
    </div>



    <footer>
        <h1><a href="https://www.linkedin.com/in/aarifkhan7896">Designed & Built by Aarif Khan</a></h1>
    </footer>


    <script src="js/jquey.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>