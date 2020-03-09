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
        
        foreach(self::$pageList as $page){
            $url = $page[0];
            $action = explode("@", $page[1]);
            
            $regex = preg_replace("/\//", "\\/", $url);
            $regex = preg_replace("/({[^\\/]+})/", "([^\\/]+)", $regex);
            if(preg_match("/^$regex$/", $currentURL, $matches)){
                $conName = "Controller\\{$action[0]}";
                $con = new $conName();
                $con->{$action[1]}(...$matches);
                exit;
            }
        }
        exit;
        redirect("/", "페이지를 찾을 수 없습니다.");
    }
}