<?php 
session_start();
require_once '../conf/config.php';
require_once '../conf/db.php';


if(! isAuthenticated()){
    header('Location: /inisev2');
    exit;
}

function logout()
{
    if( isset($_SESSION) && isset($_SESSION['user_id']) ){
        clearSession();
        session_start();
        $_SESSION['success'] = 'See you soon';
        header('Location: /inisev2');
        exit;    
    }
}

logout();

?>