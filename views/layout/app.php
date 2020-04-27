<!DOCTYPE html>
<html>
<head>
    <title>Orari</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/css/app.css"/>
    <script src="/js/app.js" defer></script>
</head>
<?php $auth = isAuthenticated()?>
<body class="<?= !$auth ? 'body-auth' : '' ?>">
    <?php if($auth): ?>
    <div id="app"></div>
    <?php else :?>
    <div id="guest" class="d-flex h-100"></div>
    <?php endif;?>
</body>
</html>
