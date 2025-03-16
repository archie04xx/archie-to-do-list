<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_task"])) {
    if (!empty($_POST["task"]) && isset($_POST["task_id"]) && is_numeric($_POST["task_id"])) {
        $task_name = trim($_POST["task"]);
        $task_id = $_POST["task_id"];
        $page = isset($_POST["page"]) ? (int)$_POST["page"] : 1;
        $completed_page = isset($_POST["completed_page"]) ? (int)$_POST["completed_page"] : 1;
        
        try {
            $stmt = $conn->prepare("UPDATE tasks SET task_name = :task_name WHERE id = :id");
            $stmt->bindParam(':task_name', $task_name);
            $stmt->bindParam(':id', $task_id, PDO::PARAM_INT);
            $stmt->execute();
            
            header("Location: index.php?page=$page&completed_page=$completed_page");
            exit();
        } catch (PDOException $e) {
            die("Error updating task: " . $e->getMessage());
        }
    } else {
        echo "Task cannot be empty.";
    }
} else {
    header("Location: index.php");
    exit();
}
?>