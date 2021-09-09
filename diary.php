<?php
session_start();
if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin']!=true){
    header("location: index.php");
    exit();
}
?>

<?php
$added=false;
include 'dbcon.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
$message = $_POST['message'];

$sql = "INSERT INTO `messages` (`message`) VALUES ('$message')";
$result = mysqli_query($dbcon, $sql);
if($result){
    $added=true;
}else{
    echo "unable to add";
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
    <title>Secret Diary</title>
</head>

<body>
    <div class="navbar">
        <div class="nav">
            <h1>Secret Diary</h1>
        </div>
        <div class="logout">
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
    <?php
            if($added){
                echo "<div class='alert alert-success alert-dismissible fade show mt-3' role='alert'>
            <strong>Success!</strong> Note has been added.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
            }
    ?>
    <div class="container">
        <form action="diary.php" method="post">
            <div class="mb-3">
                <textarea class="form-control" name="message" id="message" cols="225" rows="14"
                    style="resize: none; "></textarea>
            </div>
            <button type="submit" class="btn btn-primary" id="submit">Save</button>
        </form>
    </div>

    <script src="js/jquey.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>