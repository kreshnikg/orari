<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script src="./src/js/app.js"></script>
    <link rel="stylesheet" href="./src/css/fontawesome/css/all.css">
    <link rel="stylesheet" type="text/css" href="./src/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="./src/css/bootstrap.css"/>
</head>
<body>
<div id="sidebar" class="sidebar">
    <ul class="p-0">
        <li class="d-flex justify-content-center my-3">
            <img src="./storage/img/clock-logo-white.png" width="100"/>
        </li>
        <?php includeComponent('/components/sidebar-item',[
            "sidebarItemHref" => "/orari",
            "sidebarItemTitle" => "Orari",
            "sidebarItemIcon" => "far fa-calendar-alt"
        ]); ?>
        <?php includeComponent('/components/sidebar-item',[
            "sidebarItemHref" => "/lendet",
            "sidebarItemTitle" => "Lëndët",
            "sidebarItemIcon" => "fas fa-book-open"
        ]); ?>
        <?php includeComponent('/components/sidebar-item',[
            "sidebarItemHref" => "/studentet",
            "sidebarItemTitle" => "Studentët",
            "sidebarItemIcon" => "fas fa-user-graduate"
        ]); ?>
        <?php includeComponent('/components/sidebar-item',[
            "sidebarItemHref" => "/ligjeruesit",
            "sidebarItemTitle" => "Ligjëruesit",
            "sidebarItemIcon" => "fas fa-chalkboard-teacher"
        ]); ?>
        <li class="sidebar-item position-absolute w-100 text-center" style="bottom: 20px">
            <a class="sidebar-link" href="/logout">
                <i class="fas fa-sign-out-alt fa-fw"></i>
                <span class="ml-2">Çkyçu</span>
            </a>
        </li>
    </ul>
</div>

<div id="topbar" class="topbar">
    <a onclick="sidebarToggle()" id="sidebarToggle" class="menu">
        <i class="fa fa-bars"></i>
    </a>

    <!-- Search -->
    <div class="searchbar">
        <input type="text" placeholder="Kërko" class="searchbar-input"/>
        <button class="searchbar-button" type="button"><span class="fa fa-search"></span></button>
    </div>

    <ul class="profile-container">
        <li class="messages">
            <i class="fa fa-envelope"></i>
        </li>
        <li class="cart">
            <i class="fa fa-shopping-cart"></i>
        </li>
        <li>
            <div class="topbar-divider"></div>
        </li>
        <li class="profile-img">
            <img src="./storage/img/profile-image.png" alt="profile image"/>
        </li>
    </ul>
</div>
<div class="content">
    <div class="container-fluid">
