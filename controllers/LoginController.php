<?php
session_start();
require_once '../conf/config.php';
require_once '../conf/db.php';



if(isAuthenticated()){
    header('Location: /inisev2/pages/notice-board.php');
    exit;
}

if( ! isset($_SERVER) || $_SERVER['REQUEST_METHOD'] !== 'POST'){
    header('Location: /inisev2');
    exit;
}

$errors = [];
        
$_POST = _trim($_POST);
sanitizeData($_POST);
validateData($_POST, $errors);

if($errors){
    $_SESSION['errors'] = $errors;
    header('Location: /');
    return;
}

$user = [
    'email'=>$_POST['email'] ,
    'password' => $_POST['password']
];

try{

    $user = attempt($user);

}catch(\PDOException $e){

    if( isset($_SESSION) && isset($_SESSION['user_id']) ){
        clearSession();
    }

    $_SESSION['error'] = 'Error in Login'; // . $e->getMessage();
    header('Location: /inisev2');
    return;
}


if(! $user){
    if( isset($_SESSION) && isset($_SESSION['user_id']) ){
        clearSession();
    }
    $_SESSION['error'] = 'Not-Valid Credentials';
    header('Location: /inisev2');
    exit;
}

// valid user
setAuthenticated($user['id']);
$_SESSION['success'] = 'Welcome back '. $user['name'];

header('Location: /inisev2/pages/notice-board.php');
return;
 


function validateData($data, &$errors)
{
    if (isEmpty($data['email'])) {
        $errors['email'] = 'Email Field Can\'t be empty';
    }

    if (isset($data['email']) &&  ( !filter_var($data['email'], FILTER_VALIDATE_EMAIL) ) ) {
        $errors['email'] = 'Email Field is not valid';
    }

    if (isEmpty($data['password'])) {
        $errors['password'] = 'Password Field Can\'t be empty';
    }

}

function sanitizeData()
{
    $_POST['email'] = sanitize($_POST['email'], 'email');
    $_POST['password'] = sanitize($_POST['password']);
    return;
}

?>