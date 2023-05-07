<?php
    session_start();
    require_once __DIR__.'/../conf/config.php';
    require_once __DIR__.'/../conf/db.php';
    
    $messages = array();
 
    if( isset($_SERVER) && $_SERVER['REQUEST_METHOD'] === 'GET'){
        if(strpos($_SERVER['REQUEST_URI'], 'add-message')){
            addMessage();
        }else{
            getMessages();
        }
    }

    if( isset($_SERVER) && $_SERVER['REQUEST_METHOD'] === 'POST'){
        storeMessage();
    }
    
function addMessage()
{
    if(! isAuthorized('admin')){
        $_SESSION['err'] = 'You don\'t have permission for this request !';
        header('Location: /inisev2/pages/notice-board.php');
        return;
    }
}


function getMessages()
{
    if(! isAuthenticated()){
        $_SESSION['error'] = 'You must be authenticated first';
        header('Location: /inisev2');
        exit;
    }
    global $messages;
    $messages = SQL::getAll('messages');
    return;
}

function storeMessage()
{
    if(! isAuthorized('admin')){
        $_SESSION['error'] = 'You don\'t have permission for this request !';
        header('Location: /inisev2/pages/notice-board.php');
        exit;
    }

    $errors = [];

    // die if CSRF 
    checkValidCSRFToken();

    $_POST = _trim($_POST);
    sanitizeData();
    validateData($_POST, $errors);

    if($errors){
        $_SESSION['errors'] = $errors;
        header('Location: /inisev2/pages/add-message.php');
        return;
    }
    
    $params = [
        ':subject' => $_POST['subject'],
        ':message' => $_POST['message'],
    ];
    
    $query = 'insert into `messages` (`id`, `subject`, `message`) VALUES (NULL, :subject, :message)';
    try{
        SQL::save($query, $params);
    }catch(\PDOException $e){
        $_SESSION['error'] = 'Error in sending message'; // . $e->getMessage();
        header('Location: /inisev2/pages/add-message.php');
        return;
    }

    $_SESSION['success'] = 'Message Stored Successfully';
    header('Location: /inisev2/pages/notice-board.php');
    return;
}


function validateData($data, &$errors)
{
        if (isEmpty($data['subject'])) {
        $errors['subject'] = 'Subject Field Can\'t be empty';
    }

    if (isEmpty($data['message'])) {
        $errors['message'] = 'Message Field Can\'t be empty';
    }
    return;
}

function sanitizeData()
{
    $_POST['subject'] = sanitize($_POST['subject']);
    $_POST['message'] = sanitize($_POST['message']);
    return;
}
?>