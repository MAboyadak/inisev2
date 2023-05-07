<?php 
session_start();
require_once 'conf/config.php';
require_once 'conf/db.php';

include_once 'partials/header.php';

    if(isAuthenticated()){
        header('Location: /inisev2/pages/notice-board.php');
        exit;
    }
    include_once 'pages/login.php';

include_once 'partials/footer.php';

?>