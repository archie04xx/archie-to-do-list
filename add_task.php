<?php
    include 'db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_task"])) {
         if (!empty($_POST["task"])) {
              $task_name = trim($_POST["task"]);

                try {
                    $stmt = $conn->prepare("INSERT INTO tasks (task_name) VALUES (:task_name)");
                    $stmt->bindParam(':task_name', $task_name);
                    $stmt->execute();

                    header("Location: index.php");
                    exit();
                } catch (PDOException $e) {
                die("Error adding task: " . $e->getMessage());
                }
    } else {
        echo "Task cannot be empty.";
    }
}
?>