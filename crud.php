<?php  
include('db.php');
if (!isset($_SESSION['user_id'])) {
    header('location:index.php');
}

?>
<?php include('partials/header.php')?>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <?php if (isset($_SESSION['message_task'])) {?>

                <div class="alert alert-<?= $_SESSION['message_task_type']?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message_task'];?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php }?>
                    <div class="card card-body">
                        <form action="save_task.php" method="POST">
                            <div class="form-group">
                                <input type="text" name="title" placeholder="Write The Title" class="form-control" autofocus required maxlength="50">
                            </div>
                            <div class="form-group">
                                <textarea name="description" rows="2" placeholder="Write The Description" class="form-control" required></textarea>
                            </div>
                            <input type="submit" name="send_task" value="Send Task" class="btn btn-success btn-block">
                        </form>
                    </div>
            </div>
            <div class="col-md-8">
                <table class="table table-bordered">
                    <thead>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT task.title, task.description, task.created_at, task.id from task where task.id_user = :id_user";
                        $stmt =$conexion->prepare($sql);
                        $stmt->bindParam(':id_user', $_SESSION['user_id']);
                        $stmt->execute();
                        while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){?>
                            <tr>
                                <td><?php echo $row['title']?></td>
                                <td><?php echo $row['description']?></td>
                                <td><?php echo $row['created_at']?></td>
                                <td>
                                <a href="edit_task.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                                    <i class="fas fa-marker"></i> 
                                </a>
                                <a href="delete_task.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include('partials/footer.php')?>