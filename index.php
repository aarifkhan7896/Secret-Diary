<?php
$created = false;
$exits=false;
include 'dbcon.php';

if($_SERVER['REQUEST_METHOD']=="POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userexist = "SELECT * FROM `user` WHERE `email` = '$email'";
    $existresult = mysqli_query($dbcon, $userexist);
    $existnum = mysqli_num_rows($existresult);
    if($existnum>0){
        $exits = true;
    }else{
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `user` (`email`, `password`) VALUES ('$email', '$hash')";
        $result = mysqli_query($dbcon, $sql);
        if($result){
            $created = true;
        }else{
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Error!</strong> Unable to create account. Try again later.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
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
    <title>Secret Diary | Sign Up!</title>
</head>

<body>


    <div class="container">
        <div class="form">
            <h1>Secret Diary</h1>
            <p>Store your thoughts permanently & securely.</p>
            <?php
            if($created){
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Congratulations!</strong> Your account has been created.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
            }
            ?>
            <?php
            if($exits){
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Alert!</strong> User already exist.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
            }
            ?>
            <span>Interested? Sign up now.</span>
            <form action="index.php" method="post">
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
                <button type="submit" name="submit" class="btn btn-success" id="btn">Sign Up!</button>
            </form>
            <div class="mt-3">
                <a href="login.php" class="btn btn-outline-primary">Log in</a>
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