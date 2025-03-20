<?php
include("db.php");
include("pagination.php");
include("pagination_dsp.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <aside class="header">
        <a href="portfolio.php"><h2>Portfolio</h2></a>
        <h2>|</h2>
        <a href="index.php"><h2>To-Do List</h2></a>
    </aside>

    <main class="main-content">
        <h2>New Task</h2>
        <form action="add_task.php" method="POST" class="add-task">
            <input type="text" name="task" placeholder="Task" required>
            <button type="submit" name="add_task">Add Task</button>
        </form>

        <h3>Task Lists</h3>
        <ul class="task-list">
            <?php if (count($active_tasks) > 0): ?>
                <?php foreach ($active_tasks as $task): ?>
                    <li>
                        <span class="task-name"><?= htmlspecialchars($task['task_name']); ?></span>
                        <div class="task-actions">
                            <a href="complete_task.php?id=<?= $task['id']; ?>&page=<?= $page; ?>&completed_page=<?= $completed_page; ?>" class="complete-btn">✔ </a>
                            <a href="edit_task_form.php?id=<?= $task['id']; ?>&page=<?= $page; ?>&completed_page=<?= $completed_page; ?>" class="edit-btn">✏️</a>   
                            <a href="delete_task.php?id=<?= $task['id']; ?>&page=<?= $page; ?>&completed_page=<?= $completed_page; ?>" class="delete-btn" >❌</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No active tasks</li>
            <?php endif; ?>
        </ul>
        
        <?php render_active_pagination($page, $active_total_pages, $completed_page); ?>

        <h3>Completed Tasks✅</h3>
        <ul class="completed-list">
            <?php if (count($completed_tasks) > 0): ?>
                <?php foreach ($completed_tasks as $task): ?>
                    <li>
                        <?= htmlspecialchars($task['task_name']); ?> ✅
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No completed tasks</li>
            <?php endif; ?>
        </ul>
        
        <?php render_completed_pagination($page, $completed_page, $completed_total_pages); ?>
    </main>
</div>

</body>
</html>
