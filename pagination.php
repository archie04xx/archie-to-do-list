<?php
$items_per_page = 5; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$completed_page = isset($_GET['completed_page']) ? (int)$_GET['completed_page'] : 1;

$stmt = $conn->query("SELECT COUNT(*) as active_count FROM tasks WHERE is_completed = 0");
$active_count = $stmt->fetch(PDO::FETCH_ASSOC)['active_count'];

$stmt = $conn->query("SELECT COUNT(*) as completed_count FROM tasks WHERE is_completed = 1");
$completed_count = $stmt->fetch(PDO::FETCH_ASSOC)['completed_count'];

$active_total_pages = ceil($active_count / $items_per_page);
$completed_total_pages = ceil($completed_count / $items_per_page);

$page = max(1, min($page, max(1, $active_total_pages)));
$completed_page = max(1, min($completed_page, max(1, $completed_total_pages)));

$active_offset = ($page - 1) * $items_per_page;
$completed_offset = ($completed_page - 1) * $items_per_page;

$stmt = $conn->prepare("SELECT * FROM tasks WHERE is_completed = 0 ORDER BY created_at DESC LIMIT :limit OFFSET :offset");
$stmt->bindParam(':limit', $items_per_page, PDO::PARAM_INT);
$stmt->bindParam(':offset', $active_offset, PDO::PARAM_INT);
$stmt->execute();
$active_tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT * FROM tasks WHERE is_completed = 1 ORDER BY created_at DESC LIMIT :limit OFFSET :offset");
$stmt->bindParam(':limit', $items_per_page, PDO::PARAM_INT);
$stmt->bindParam(':offset', $completed_offset, PDO::PARAM_INT);
$stmt->execute();
$completed_tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>