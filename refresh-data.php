<?php

    session_start();
    require_once 'conf/config.php';
    require_once 'conf/db.php';

    // if(! isAuthenticated()){
    //     $_SESSION['error'] = 'You must be authenticated first';
    //     header('Location: /inisev2');
    //     exit;
    // }

    $messages = SQL::getAll('messages');
    $result = "";
    $i = 1;
    foreach ($messages as $msg){
        $result .= "<tr>";
        $result .= "<td>" . $i . '</td>';
        $result .= "<td>" . $msg['subject'] . "</td>";
        $result .= "<td>" . $msg['message'] . "</td>";
        $result .= "</tr>";
        $i ++;
    }
     
    echo json_encode($result);



?>