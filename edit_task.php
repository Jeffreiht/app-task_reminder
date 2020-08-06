<?php
include('db.php');

if (isset($_GET['id'])) {
    $sql = "SELECT * FROM task WHERE id=:id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();

    if ($stmt) {
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        $title = $row['title'];
        $description = $row['description'];
    }
}

if (isset($_POST['update'])) {
    $sql = "UPDATE task set id_user = :id_user, title = :title, description = :description WHERE id=:id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id_user', $_SESSION['user_id']);
    $stmt->bindParam(':title', $_POST['title']);
    $stmt->bindParam(':description', $_POST['description']);
    $stmt->bindParam(':id', $_GET['id']);

    if ($stmt->execute()) {
        $_SESSION['message_task'] = "Task Update Successfully";
        $_SESSION['message_task_type'] = "warning";
        header('location: crud.php');
    }
}
?>

<?php include('partials/header.php')?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="edit_task.php?id=<?php echo $_GET['id']?>" method="POST">
                    <div class="form-group">
                        <input type="text" name="title" placeholder="Update Title" autofocus maxlength="50" class="form-control" value="<?php echo $title?>" required>
                    </div>
                    <div class="form-group">
                        <textarea name="description" rows="2" placeholder="Update Description" class="form-control" required><?php echo $description?></textarea>
                    </div>
                    <input type="submit" name="update" class="btn btn-success" value="Update Task">
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('partials/footer.php')?>