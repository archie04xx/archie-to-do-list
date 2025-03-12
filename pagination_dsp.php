<?php
function render_active_pagination($page, $active_total_pages, $completed_page) {
    if ($active_total_pages > 1): ?>
        <ul class="pagination">
            <?php if ($page > 1): ?>
                <li><a href="?page=<?= $page-1 ?>&completed_page=<?= $completed_page ?>">Previous</a></li>
            <?php endif; ?>
            
            <?php for ($i = 1; $i <= $active_total_pages; $i++): ?>
                <li><a href="?page=<?= $i ?>&completed_page=<?= $completed_page ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a></li>
            <?php endfor; ?>
            
            <?php if ($page < $active_total_pages): ?>
                <li><a href="?page=<?= $page+1 ?>&completed_page=<?= $completed_page ?>">Next</a></li>
            <?php endif; ?>
        </ul>
    <?php endif;
}
function render_completed_pagination($page, $completed_page, $completed_total_pages) {
    if ($completed_total_pages > 1): ?>
        <ul class="pagination">
            <?php if ($completed_page > 1): ?>
                <li><a href="?page=<?= $page ?>&completed_page=<?= $completed_page-1 ?>">Previous</a></li>
            <?php endif; ?>
            
            <?php for ($i = 1; $i <= $completed_total_pages; $i++): ?>
                <li><a href="?page=<?= $page ?>&completed_page=<?= $i ?>" class="<?= ($i == $completed_page) ? 'active' : '' ?>"><?= $i ?></a></li>
            <?php endfor; ?>
            
            <?php if ($completed_page < $completed_total_pages): ?>
                <li><a href="?page=<?= $page ?>&completed_page=<?= $completed_page+1 ?>">Next</a></li>
            <?php endif; ?>
        </ul>
    <?php endif;
}
?>