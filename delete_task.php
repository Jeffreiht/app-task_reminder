<?php
include('db.php');

if (isset($_GET['id'])) {
    $sql = "DELETE FROM task WHERE id=:id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id',$_GET['id']);
    if ( $stmt->execute()) {
        $_SESSION['message_task'] = "Task Removed Successfully";
        $_SESSION['message_task_type'] = "danger";
        header('location: crud.php');
    }
}
?>