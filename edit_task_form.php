<?php
include("db.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $task_id = $_GET['id'];
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $completed_page = isset($_GET['completed_page']) ? (int)$_GET['completed_page'] : 1;
    
    try {
        $stmt = $conn->prepare("SELECT * FROM tasks WHERE id = :id");
        $stmt->bindParam(':id', $task_id, PDO::PARAM_INT);
        $stmt->execute();
        
        $task = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$task) {
            header("Location: index.php");
            exit();
        }
    } catch (PDOException $e) {
        die("Error retrieving task: " . $e->getMessage());
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="edit-container">
    <h2>Edit Task</h2>
    <form action="update_task.php" method="POST" class="edit-form">
        <input type="hidden" name="task_id" value="<?= $task['id']; ?>">
        <input type="hidden" name="page" value="<?= $page; ?>">
        <input type="hidden" name="completed_page" value="<?= $completed_page; ?>">
        
        <label for="task">Task</label>
        <input type="text" name="task" id="task" value="<?= htmlspecialchars($task['task_name']); ?>" required>
        
        <div class="button-group">
            <button type="submit" name="update_task" class="save-btn">Save Changes</button>
            <a href="index.php?page=<?= $page; ?>&completed_page=<?= $completed_page; ?>" class="cancel-btn">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>