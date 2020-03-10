<?php
namespace Controller;

use Engine\DB;

class MainController {
    function indexPage(){
        $lastest = DB::fetch("SELECT * FROM sites ORDER BY created_at DESC");
        $lastest ? redirect("/{$lastest->code}") : redirect("/admin", "생성된 사이트가 없습니다. 로그인 페이지로 이동합니다.");
    }

    function teaserPage($code){
        $site = DB::fetch("SELECT * FROM sites WHERE code = ?", [$code]);
        $site == false && back("해당 사이트는 존재하지 않습니다.");

        $address = $_SERVER['REMOTE_ADDR'];
        $referer = preg_replace("/(https?:\/\/[^\/]+).*/", "$1", (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ""));

        dd($_SERVER['HTTP_USER_AGENT']);
        dd($_SERVER);
        
        teaserView($site);
    }
}