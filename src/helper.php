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

function isEmpty($exception = [], $resJson = false){
    foreach($_POST as $key => $input){
        if(trim($input) === "" && in_array($key, $exception) == false) 
            return $resJson ? json_response(["message" => "모든 정보를 기입해 주십시오."]) : back("모든 정보를 기입해 주십시오.");
    }
}

function view($pageName, $data = []){
    $data['pageName'] = $pageName;
    extract($data);

    require VIEWS.DS."components".DS."header.php";
    require VIEWS.DS.$pageName.".php";
    require VIEWS.DS."components".DS."footer.php";
}

function teaserView($site){
    require VIEWS.DS."components".DS."header.php";
    echo $site->contents;
    require VIEWS.DS."components".DS."teaser-footer.php";
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

/**
 * 브라우저 정보를 가져오는 함수
 */
function browserInfo(){
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $browser = $o_system = $version = "Unknown";
    
    // 운영체제 확인
    if(preg_match("/Android/i", $u_agent)) $o_system = "Android";
    else if(preg_match("/linux/i", $u_agent)) $o_system = "Linux";
    else if(preg_match("/macintosh|mac os x/i", $u_agent)) $o_system = "iOS";
    else if(preg_match("/windows|win32/i", $u_agent)) $o_system = "Windows";

    // 브라우저 확인
    if(preg_match("/MSIE/i", $u_agent) && !preg_match("/Opera/i", $u_agent)) { $browser = "IE"; $base = "MSIE"; }
    else if(preg_match("/Firefox/i", $u_agent)){ $browser = "Firefox"; $base = "Firefox"; }
    else if(preg_match("/OPR/i", $u_agent)){ $browser = "Opera"; $base = "Opera"; }
    else if(preg_match("/Whale/i", $u_agent)){ $browser = "Whale"; $base = "Whale"; }
    else if(preg_match("/Chrome/i", $u_agent) && !preg_match("/Edge/i", $u_agent)){ $browser = "Chrome"; $base = "Chrome"; }
    else if(preg_match("/Safari/i", $u_agent) && !preg_match("/Edge/i", $u_agent)){ $browser = "Safari"; $base = "Safari"; }
    else if(preg_match("/Netscape/i", $u_agent)){ $browser = "Netscape"; $base = "Netscape"; }
    else if(preg_match("/Edge/i", $u_agent)){ $browser = "Edge"; $base = "Edge"; }
    else if(preg_match("/Trident/i", $u_agent)){ $browser = "IE"; $base = "MSIE"; }

    preg_match_all("/(?<browser>Version|{$base}|other)[\/ ]+(?<version>[0-9.]*)/", $u_agent, $matches);
    $m_cnt = count($matches['browser']);
    if ($m_cnt != 1) {
        // 버전이 두가지 이상 찍힐 경우
        // 버전이 이름 앞/뒤에 있는지 확인
        if (strripos($u_agent, "Version") < strripos($u_agent, $base)){
            $version = $matches['version'][0];
        }else {
            $version = $matches['version'][1];
        }
    }else {
        $version = $matches['version'][0];
    }

    // 그래도 버전이 확인되지 않는다면 모르는 것..
    if (!$version) $version = "Unknown";

    return (object)["user_agent" => $u_agent, "browser" => $browser, "version" => $version, "os" => $o_system];
}

function isMobile(){
    $phoneArr = ["iphone","lgtelecom","skt","mobile","samsung","nokia","blackberry","android","android","sony","phone"];
    $result = false;
    foreach($phoneArr as $ph) {
        if(preg_match("/{$ph}/i", $_SERVER['HTTP_USER_AGENT'])) $result = true;
    }
    return $result;
}


function random_color($image, $min = 150, $max = 255){
    $result = [rand($min + 50, $max)];
    for($i = 1; $i < 3; $i++){
        $result[] = rand($min - 20, $result[$i - 1] - 20);
    }
    shuffle($result);
    return imagecolorallocate($image, ...$result);
}
