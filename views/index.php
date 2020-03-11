<?php
    include './views/layout/header.php';

    foreach ($users as $user) {
        echo $user->emri . '<br>';
    }

    include './views/layout/footer.php';


