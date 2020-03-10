<?php
namespace Engine;


class Router {
    static $pageList = [];
    static function __callStatic($fn, $args){
        if(strtoupper($fn) === $_SERVER['REQUEST_METHOD']){
            self::$pageList[] = $args;
        }
    }
    static function connect(){
        $currentURL = filter_var(rtrim(explode("?", $_SERVER['REQUEST_URI'])[0]), FILTER_SANITIZE_URL);
        // dd($currentURL);

        foreach(self::$pageList as $page){
            $url = $page[0];
            $action = explode("@", $page[1]);
            $permission = isset($page[2]) ? $page[2] : null;
            
            $regex = preg_replace("/\//", "\\/", $url);
            $regex = preg_replace("/({[^\\/]+})/", "([^\\/]+)", $regex);

            // URL 일치
            if(preg_match("/^$regex$/", $currentURL, $matches)){
                if($permission === "user" && !user()) redirect("/admin", "로그인 후 이용하실 수 있습니다.");
                else if($permission === "guest" && user()) back("로그인 후엔 이욯하실 수 없습니다.");

                $conName = "Controller\\{$action[0]}";
                $con = new $conName();
                $con->{$action[1]}(...$matches);
                exit;
            }
        }
        echo "페이지를 찾을 수 없습니다.";
    }
}