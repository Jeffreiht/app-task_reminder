<?php 
include('db.php');



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD CON PHP</title>
    <!--  Fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,100&display=swap" rel="stylesheet">
    <!--  BOOTSTRAP 4.5  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- FONT AWESOME 5  -->
    <script src="https://kit.fontawesome.com/f9289ec2a7.js" crossorigin="anonymous"></script>
    <!-- CSS  -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <a href="index.php" class="navbar navbar-brand">TASK REMINDER</a>
        <?php if (isset($_SESSION['user_name'])):?>
            <p style="color:white">
                <?php 
                    echo $_SESSION['user_name']."&nbsp";
                    echo $_SESSION['user_last_name']."&nbsp";
                ?>
                <a href="logout.php">
                    <i class="fas fa-user-circle"></i>
                </a>
            </p>
                
        <?php endif;?>
    </nav>
