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
    exit;
}

function back($message = null){
    echo "<script>";
    if($message) echo "alert('$message');";
    echo "history.back();";
    echo "</script>";
    exit;
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

    require VIEWS.DS."components".DS."header.php";
    require VIEWS.DS.$pageName.".php";
    require VIEWS.DS."components".DS."footer.php";
}


function random_str($length = 30){
    $str = "qwertyuiopasdfghjklzxcvbnm1234567890";
    $result = "";
    for($i = 0; $i < $length; $i++){
        $result .= $str[rand(0, strlen($str) - 1)];
    }
    return $result;
}

function json_response($data) {
    header("Content-Type: application/json");
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}