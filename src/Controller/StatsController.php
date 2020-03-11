<?php
namespace Controller;

use Engine\DB;

class StatsController {
    function statsPage($type, $code){
        // 타입 검사 및 이름 설정, 기본값: device
        switch($type){
            case "referer": $typeName = "유입경로"; break;
            case "os": $typeName = "운영체제"; break;
            case "browser": $typeName = "브라우저"; break;
            case "device": 
            default: $typeName = "디바이스"; $type = "device";
        }
        $viewData['typeName'] = $typeName;
        $viewData['info'] = $this->getInfo($type, $code);
        $viewData['queryString'] = $_SERVER['QUERY_STRING'];
        dd($viewData);
        view("stats", $viewData);
    }
    

    /**
     * 통계 데이터 정보를 반환한다.
     */
    protected function getInfo($type, $code){
        $result = [];
        $where = "WHERE code = :code";
        $params = [":code" => $code];

        if(isset($_GET['from-date'])){
            $where .= " AND timestamp(access_at) >= timestamp(:from_date)";
            $params[":from_date"] = $_GET['from-date'];
        }
        if(isset($_GET['to-date'])){
            $where .= " AND timestamp(access_at) >= timestamp(:to_date)";
            $params[":to_date"] = $_GET['to-date'];
        }

        $result['all'] = DB::fetch("SELECT COUNT(*) AS cnt FROM accesses {$where}", $params)->cnt;
        $result['each'] = [];
        $countEach = DB::fetchAll("SELECT {$type} AS col, COUNT(*) AS cnt FROM accesses {$where} GROUP BY {$type}", $params);
        foreach($countEach as $item){
            $result['each'][] = [$item->col, $item->cnt];
        }
        
        return $result;
    }
}