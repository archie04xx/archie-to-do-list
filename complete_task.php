<?php
    include("db.php");
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $task_id = $_GET['id'];
    
        try {
            $stmt = $conn->prepare("UPDATE tasks SET is_completed = 1 WHERE id = :id");
            $stmt->bindParam(':id', $task_id, PDO::PARAM_INT);
            $stmt->execute();
    
            header("Location: index.php");
            exit();
        } catch (PDOException $e) {
            die("Error completing task: " . $e->getMessage());
        }
    } else {
        header("Location: index.php");
        exit();
    }
?>