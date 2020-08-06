<?php 

include("db.php");
$mensaje = '';

if(isset($_POST['send_task'])){
    $sql = "INSERT INTO task (id_user,title, description)VALUES(:id_user,:title, :description)";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id_user', $_SESSION['user_id']);
    $stmt->bindParam(':title', $_POST['title']);
    $stmt->bindParam(':description', $_POST['description']);
    
    if ($stmt->execute()) {
        $_SESSION['message_task'] = "Task Saved Successfully";
        $_SESSION['message_task_type'] ="success";
    }else {
        $_SESSION['message_task'] = "Error Saving Your Task";
        $_SESSION['message_task_type'] = "danger";
    }
    header('location: crud.php');
}


?>