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

        // 사이트 접근 기록 추가
        $info = browserInfo();
        $isMobile = isMobile();
        $input = [
            ":code" => $code,
            ":address" => $_SERVER['REMOTE_ADDR'],
            ":referer" => preg_replace("/(https?:\/\/[^\/]+).*/", "$1", (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "Unknown")),
            ":os" => $info->os,
            ":browser" => $info->browser . " " . $info->version,
            ":device" => $isMobile ? "Mobile" : "PC"
        ];
        DB::query("INSERT INTO accesses(code, address, referer, os, browser, device) VALUES (:code, :address, :referer, :os, :browser, :device)", $input);
        
        
        teaserView($site);
    }
}