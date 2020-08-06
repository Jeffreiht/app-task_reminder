<?php

include('db.php');

if (isset($_SESSION['user_id'])) {
    header('location:crud.php');
}
?>

<?php include('partials/header.php')?>

    <h1>Please Login or SignUp</h1>

    <a href="login.php">Login</a> or
    <a href="signup.php">SignUp</a>

<?php include('partials/footer.php')?>