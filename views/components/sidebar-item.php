<?php
$uri = $_SERVER["REQUEST_URI"];
?>
<li class="sidebar-item <?= $uri == $sidebarItemHref ? 'active' : '' ?>">
    <a class="sidebar-link" href="<?= $sidebarItemHref?>">
        <i class="<?= $sidebarItemIcon?> fa-fw"></i>
        <span class="ml-2"><?= $sidebarItemTitle ?></span>
    </a>
</li>
