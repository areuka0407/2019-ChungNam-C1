<?php
namespace Controller;

use Engine\DB;

class MainController {
    function indexPage(){
        $lastest = DB::fetch("SELECT * FROM sites ORDER BY craeted_at DESC");
        $lastest ? redirect("/{$lastest->code}") : redirect("/admin", "생성된 사이트가 없습니다. 로그인 페이지로 이동합니다.");
    }

    function builderPage(){
        view("teaser_builder");
    }
    
    function setSite(){
        

        json_response($_POST['name']);
    }
}