<?php
namespace Controller;

use Engine\DB;

class BuilderController {
    function builderPage(){
        view("teaser_builder");
    }
    
    function setSite(){
        isEmpty(["title", "description", "keyword"], true);
        extract($_POST);

        $overlap =  DB::fetch("SELECT * FROM sites WHERE code = ?", [$code]);
        if($overlap) {
            DB::query("UPDATE stes SET name = ?, title = ?, description = ?, keyword = ?, contents = ?", [$name, $title, $description, $keyword, $contents]);
            json_response(["message" => "해당 사이트의 정보가 업데이트 되었습니다."]);
        }
        else {
            DB::query("INSERT INTO sites(code, name, title, description, keyword, contents) VALUES (?, ?, ?, ?, ?, ?)", [$code, $name, $title, $description, $keyword, $contents]);
            json_response(["message" => "현재 페이지가 적용되었습니다.", "action" => "location.assign('/{$code}')"]);
        }

    }

    function setImage(){
        isEmpty([], true);
        extract($_POST);

        $dirPath = str_replace("/", DS, substr($path, 0, strrpos($path, "/")));
        if(is_dir(PUB.$dirPath) == false) json_response(["message" => "해당 경로가 존재하지 않습니다."]);

        $exp = substr($path, strrpos($path, "."));
        $scan = scandir(PUB.$dirPath);
        $imageName = (count($scan) - 1) . $exp;
        
        $contents = substr($url, strpos($url, "base64") + 7);
        file_put_contents(PUB . $dirPath . DS . $imageName, base64_decode($contents));

        json_response(["message" => "정상적으로 업로드 되었습니다.", "filename" => $dirPath . DS . $imageName]);
    }

    function getImageCount(){
        isEmpty([], true);
        extract($_POST);

        $count = 0;
        if(is_dir(PUB.$path)){
            $scan = scandir(PUB.str_replace("/", DS, $path));  
            $count = count($scan) - 2;
        }

        json_response($count);
    }
}