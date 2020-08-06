<?php 

include('db.php');

if (isset($_SESSION['user_id'])) {
    header('location:crud.php');
}
if (isset($_POST['send'])) {
    $records = $conexion->prepare("SELECT id, nombre, apellido, email, password FROM users WHERE email=:email");
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    if (($results) && password_verify($_POST['password'], $results['password'])) {
        $_SESSION['user_id'] = $results['id'];
        $_SESSION['user_name'] = $results['nombre'];
        $_SESSION['user_last_name'] = $results['apellido'];
        header('location:crud.php');
    }else {
        $_SESSION['message_login'] ='Sorry, Those Credencials do no Match';
        $_SESSION['message_login_type'] = 'danger';
    }
}

?>



<?php include('partials/header.php')?>

    <div class="container p-4">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <?php if (isset($_SESSION['message_login'])) {?>
                    <div class="alert alert-<?= $_SESSION['message_login_type']?> alert-dismissible fade show" role="alert">
                        <?= $_SESSION['message_login'];?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php session_unset(); }?>
                <h1>Login</h1>
                <span>or <a href="signup.php">SignUp</a></span>
                <div class="card card-body">
                    <form action="login.php" method="POST">
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Enter Your Email" autofocus class="form-control" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Enter Your Password" class="form-control" maxlength="50" required>
                        </div>
                        <input type="submit" name="send" value="Login" class="btn btn-success btn-block"> 
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include('partials/footer.php')?>