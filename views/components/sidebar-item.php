<?php
$parsedUrl = parse_url($_SERVER["REQUEST_URI"]);
$path = $parsedUrl["path"]
?>
<?php if(true): ?>
<li class="sidebar-item <?= $path == $sidebarItem_href ? 'active' : '' ?>">
    <a class="sidebar-link" href="<?= $sidebarItem_href?>">
        <i class="<?= $sidebarItem_icon?> fa-fw"></i>
        <span class="ml-2"><?= $sidebarItem_title ?></span>
    </a>
</li>
<?php endif ?>
