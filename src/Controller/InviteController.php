<?php
namespace Controller;

use Engine\DB;
use ZipArchive;

class InviteController {
    function formPage(){
        $viewData['sites'] = DB::fetchAll("SELECT * FROM sites ORDER BY created_at DESC");
        view("invite-form", $viewData);
    }

    function previewListPage(){
        isEmpty();
        extract($_POST);
        $site = DB::fetch("SELECT * FROM sites WHERE code = ?", [$code]);
        if(!$site) back("해당 사이트를 찾을 수 없습니다.");

        $file = $_FILES['invite-file'];
        if(!$file) back("초대장 파일을 업로드해 주십시오.");
        $result = $this->readExcelFile($file);

        $viewData['code'] = $code;
        $viewData['festival'] = $name;
        $viewData['thead'] = array_shift($result);
        $viewData['tbody'] = $result;

        view("invite-preview-list", $viewData);
    }

    function previewPage(){
        $viewData = _get(["name", "email", "festival", "code"]);
        extract($viewData);
        $viewData['site'] = DB::fetch("SELECT * FROM sites WHERE code = ?", [$code]);
        view("invite-preview", $viewData);
    }

    protected function readExcelFile($file){
        $savePath = SAMPLE.DS."sample.xlsx";
        $extractPath = SAMPLE.DS."extract";

        $sheetPath = "/xl/worksheets/sheet1.xml";
        $stringPath = "/xl/sharedStrings.xml";

        if(!move_uploaded_file($file['tmp_name'], $savePath)) back("파일 업로드에 실패했습니다.");
        
        $zip = new ZipArchive();
        $isOpend = $zip->open($savePath);
        if($isOpend == false) back("파일을 열 수 없습니다.");
        $zip->extractTo($extractPath);
        $zip->close();

        $strings = simplexml_load_file($extractPath . $stringPath);
        $sheet = simplexml_load_file($extractPath . $sheetPath);
        
        if(!$strings || !$sheet->sheetData) back("잘못된 엑셀 파일입니다.");

        $result = [];
        $rows = $sheet->sheetData->row;
        foreach($rows as $row){
            $data = [];
            foreach($row->c as $col){
                $idx = (int)$col->v;
                if(!is_null($strings->si[$idx])) $data[] = (string)$strings->si[$idx]->t;
                else $data[] = (string)$col->v;
            }
            $result[] = $data;
        }

        unlink($savePath);
        rmdirall($extractPath);
        return $result;
    }
}