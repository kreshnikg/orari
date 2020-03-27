<!DOCTYPE html>
<html>
<head>
    <title>Orari</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/src/css/fontawesome/css/all.css">
    <link rel="stylesheet" type="text/css" href="/src/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="/src/css/bootstrap.css"/>
    <script src="/src/js/react.js"></script>
    <script src="/src/js/react-dom.js"></script>
    <script src="/src/js/babel.js"></script>
    <script src="/src/js/jquery.min.js"></script>
    <script src="/src/js/moment.min.js"></script>
    <script src="/src/js/daterangepicker.min.js"></script>
    <script src="/src/js/app.js"></script>
    <link rel="stylesheet" type="text/css" href="/src/css/daterangepicker.css"/>
</head>
<body>
<script type="text/babel">
    const Clock = () => {
        const [state, setState] = React.useState("");
        React.useEffect(() => {
            setInterval(setTime, 1000);
        });
        const setTime = () => {
            let time = moment().format("dddd, MMMM D YYYY, H:mm:ss");
            let mappings = [
                {Monday: "E Hënë"},
                {Tuesday: "E Martë"},
                {Wednesday: "E Mërkurë"},
                {Thursday: "E Enjte"},
                {Friday: "E Premte"},
                {Saturday: "E Shtunë"},
                {Sunday: "E Dielë"},
                {January: "Janar"},
                {February: "Shkurt"},
                {March: "Mars"},
                {April: "Prill"},
                {May: "Maj"},
                {June: "Qershor"},
                {July: "Korrik"}
            ];
            mappings.map((map) => {
                Object.keys(map).forEach((key) => {
                    time = time.replace(key, map[key]);
                });
            });
            setState(time)
        };
        return <React.Fragment>{state}</React.Fragment>
    };
    ReactDOM.render(<Clock/>, document.getElementById('clock'));
</script>
<div id="sidebar" class="sidebar">
    <ul class="p-0">
        <li class="d-flex justify-content-center my-3">
            <img src="/storage/img/clock-logo-white.png" width="100"/>
        </li>
        <?php includeComponent('/components/sidebar-item', [
            "href" => "/orari",
            "title" => "Orari",
            "icon" => "far fa-calendar-alt"
        ], "sidebarItem"); ?>
        <?php includeComponent('/components/sidebar-item', [
            "href" => "/schedules",
            "title" => "Terminet",
            "icon" => "far fa-clock"
        ], "sidebarItem"); ?>
        <?php includeComponent('/components/sidebar-item', [
            "href" => "/subjects",
            "title" => "Lëndët",
            "icon" => "fas fa-book-open"
        ], "sidebarItem"); ?>
        <?php includeComponent('/components/sidebar-item', [
            "href" => "/students",
            "title" => "Studentët",
            "icon" => "fas fa-user-graduate"
        ], "sidebarItem"); ?>
        <?php includeComponent('/components/sidebar-item', [
            "href" => "/teachers",
            "title" => "Ligjëruesit",
            "icon" => "fas fa-chalkboard-teacher"
        ], "sidebarItem"); ?>
        <li class="sidebar-item position-absolute w-100 text-center" style="bottom: 20px">
            <a class="sidebar-link" href="/logout">
                <i class="fas fa-sign-out-alt fa-fw"></i>
                <span class="ml-2">Çkyçu</span>
            </a>
        </li>
    </ul>
</div>

<div id="topbar" class="topbar">
    <a onclick="" id="sidebarToggle" class="menu">
        <i class="fa fa-bars"></i>
    </a>

    <div class="searchbar">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Kërko" class="searchbar-input"/>
            <button class="searchbar-button" type="submit"><span class="fa fa-search"></span></button>
        </form>
    </div>

    <ul class="profile-container">
        <li id="clock"></li>
        <li>
            <div class="topbar-divider"></div>
        </li>
        <li class="profile-img">
            <img src="/storage/img/profile-image.png" alt="profile image"/>
        </li>
    </ul>
</div>
<div class="content">
    <div class="container-fluid">
