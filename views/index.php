<?php
    include './views/layout/header.php';

    foreach ($users as $user) {
        echo $user->email;
    }


    include './views/layout/footer.php';


