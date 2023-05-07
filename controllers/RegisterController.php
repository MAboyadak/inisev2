<?php

    require_once __DIR__.'/../conf/config.php';
    require_once __DIR__.'/../conf/db.php';
    session_start();
    
    if( ! isset($_SERVER) || $_SERVER['REQUEST_METHOD'] !== 'POST'){
        header('Location: /inisev2/pages/register.php');
        exit;
    }

    createNewUser();

    function createNewUser()
    {
        $errors = [];
        
        $_POST = _trim($_POST);
        sanitizeData($_POST);
        validateData($_POST, $errors);

        if($errors){
            $_SESSION['errors'] = $errors;
            header('Location: /inisev2/pages/register.php');
            return;
        }
                
        $params = [
            ':name' => $_POST['name'],
            ':email' => $_POST['email'],
            ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        ];

        
        try{
            DB::connect()->beginTransaction();

            $query = 'insert into `users` (`name`, `email`, `password`) VALUES (:name, :email, :password)';
            
            $user_id = SQL::save($query, $params);
            
            setAuthenticated($user_id);

            $_SESSION['success'] = 'Registeration Completed Successfully';

            DB::connect()->commit();

            header('Location: /inisev2/pages/notice-board.php');
            return;

        }catch(\PDOException $e){

            DB::connect()->rollBack();

            if( isset($_SESSION) && isset($_SESSION['user_id']) ){
                clearSession();
            }

            $_SESSION['error'] = 'Error in Registeration'; //. $e->getMessage();
            header('Location: /inisev2/pages/register.php');
            return;
        }
      
    }

    function validateData($data, &$errors)
    {
        if (isEmpty($data['name'])) {
            $errors['name'] = 'Name Field Can\'t be empty';
        }

        if (isEmpty($data['email'])) {
            $errors['email'] = 'Email Field Can\'t be empty';
        }

        if (isset($data['email']) &&  ( !filter_var($data['email'], FILTER_VALIDATE_EMAIL) ) ) {
            $errors['email'] = 'Email Field is not valid';
        }

        if (isEmpty($data['password'])) {
            $errors['password'] = 'Password Field Can\'t be empty';
        }

        if (isEmpty($data['confirm_password'])) {
            $errors['confirm_password'] = 'Confirm Password Field Can\'t be empty';
        }

        if ($data['confirm_password'] !== $data['password']){
            $errors['password'] = 'Password and cofirmation are not the same !';
        }

    }

    function sanitizeData()
    {
        $_POST['name'] = sanitize($_POST['name']);
        $_POST['email'] = sanitize($_POST['email'], 'email');
        $_POST['password'] = sanitize($_POST['password']);
        $_POST['confirm_password'] = sanitize($_POST['confirm_password']);
        return;
    }
?>