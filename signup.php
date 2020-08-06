<?php 
include("db.php");

if (isset($_SESSION['user_id'])) {
    header('location:crud.php');
}


if (isset($_POST['send-data'])) {
    $password = $_POST['password'];
    $confirm = $_POST['confirm-password'];
    if ($password == $confirm) {
        $sql = "INSERT INTO users (nombre, apellido, email, password)VALUES(:nombre, :apellido, :email, :password)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombre', $_POST['first-name']);
        $stmt->bindParam(':apellido', $_POST['last-name']);
        $stmt->bindParam(':email', $_POST['user-name']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password);
        
        if ($stmt->execute()) {
            $_SESSION['message'] = 'Succesfully created new user';
            $_SESSION['message_type'] = 'success';
        }else {
            $_SESSION['message'] = 'Sorry there must have been an issue creating your account';
            $_SESSION['message_type'] = 'danger';
        }    
    }else {
        $_SESSION['message'] = 'Passwords are not the same';
        $_SESSION['message_type'] = 'danger';
    }
}
?>


<?php include('partials/header.php')?>

    <div class="container p-4">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <?php if (isset($_SESSION['message'])) {?>
                    <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                        <?= $_SESSION['message'];?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php session_unset(); }?>
                <h1>SignUp</h1>
                <span>or <a href="login.php">Login</a></span>
                <div class="card card-body">
                    <form action="signup.php" method="POST">
                        <div class="form-group">
                            <input type="text" name="first-name" placeholder="Write Your First Name" class="form-control" maxlength="20" required autofocus>
                        </div>
                        <div class="form-group">
                            <input type="text" name="last-name" placeholder="Write Your Last Name" class="form-control" maxlength="50" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="user-name" placeholder="Write Your UserName" class="form-control" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Write Your Password" class="form-control" maxlength="50" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="confirm-password" placeholder="Confirm Your Password" class="form-control" maxlength="50" required>
                        </div>
                        <input type="submit" name="send-data" value="Send Data" class="btn btn-success btn-block">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include('partials/footer.php')?>