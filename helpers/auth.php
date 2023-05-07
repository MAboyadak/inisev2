<?php


function isAuthenticated()
{
    if( isset($_SESSION) && isset($_SESSION['user_id']) ){
        return true;
    }else{
        return false;
    }
}

function isAuthorized($role = 'user')
{
    $user = getAuth();
    if ($user['role'] == $role){
        return true;
    }else{
        return false;
    }
}

function getAuth()
{
    if(isAuthenticated()){
        return SQL::findById('users', getUserId());
    }else{
        return null;
    }
}

function getUserId()
{
    if(isAuthenticated()){
        return $_SESSION['user_id'];
    }
    return false;
}

function attempt($user)
{       
    $query = 'select * from users where email = :email';
    $params = [
        ':email' => $user['email'],
    ];
    $foundUser = SQL::findWithParams($query, $params);

    if( password_verify($user['password'], $foundUser['password']) ){
        return $foundUser;
    }else{
        return false;
    }
}

function setAuthenticated($user_id)
{
    clearSession();
    
    session_set_cookie_params([
        'lifetime' => 86400,
        'httponly' => true,
        'samesite' => 'lax'    
    ]);
    
    session_start();
    $_SESSION['user_id'] = $user_id;
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

}

function clearSession()
{
    // Unset all session variables
    $_SESSION = array();

    // delete the cookie
    setcookie(
        session_name(),
        '',
        time() - 3600
    );

    session_destroy();
    
    session_start();
    session_regenerate_id(true);    // to prevent session fixation
    session_write_close();
}

function checkValidCSRFToken(){
    
    if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('CSRF token validation failed.');
    }

}

?>