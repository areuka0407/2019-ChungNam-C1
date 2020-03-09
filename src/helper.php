<?php
function dump(){
    foreach(func_get_args() as $arg) {
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
    }
}

function dd(){
    dump(...func_get_args());
    exit;
}

function redirect($url, $message = null){
    echo "<script>";
    if($message) echo "alert('$message');";
    echo "location.href='$url';";
    echo "</script>";
}

function back($message = null){
    echo "<script>";
    if($message) echo "alert('$message');";
    echo "history.back();";
    echo "</script>";
}

function user(){
    return isset($_SESSION['user']) ? $_SESSION['user'] : false;
}

function isEmpty(){
    foreach($_POST as $input){
        if(trim($input) === "") return back("모든 정보를 기입해 주십시오.");
    }
}

function view($pageName, $data = []){
    $data['pageName'] = $pageName;
    extract($data);

    require VIEWS.DS.$pageName.".php";
}