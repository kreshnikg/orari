<?php
$uri = $_SERVER["REQUEST_URI"];
?>
<li class="sidebar-item <?= $uri == $sidebarItem_href ? 'active' : '' ?>">
    <a class="sidebar-link" href="<?= $sidebarItem_href?>">
        <i class="<?= $sidebarItem_icon?> fa-fw"></i>
        <span class="ml-2"><?= $sidebarItem_title ?></span>
    </a>
</li>
