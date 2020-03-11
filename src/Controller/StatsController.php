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
        $viewData['type'] = $type;

        $viewData['site'] = DB::fetch("SELECT * FROM sites WHERE code = ?", [$code]);
        if(!$viewData['site']) back("해당 사이트가 존재하지 않습니다.");

        $viewData['info'] = $this->getInfo($type, $code);
        $viewData['queryString'] = $_SERVER['QUERY_STRING'] !== "" ? "?" . $_SERVER['QUERY_STRING'] : "";
        view("stats", $viewData);
    }

    /**
     *  막대 그래프 띄우기
     */
    function graphBar($type, $code){
        $test = "";
        $info = $this->getInfo($type, $code);   
        $padding = 30;
        $barWidth = 30;
        $textH = 200;
        $W = 400; $H = 450;
        $width = $W - $padding * 2; 
        $height = $H - $textH;
        $image = imagecreatetruecolor($W, $H);

        imagesavealpha($image, true); // PNG 파일에서 alpha 데이터를 유지할 지의 여부
        
        // palette
        $palette = (object)[
            "transparent" => imagecolorallocatealpha($image, 255, 255, 255, 127),
            "black" => imagecolorallocate($image, 0, 0, 0),
            "lightBlack" => imagecolorallocate($image, 60, 60, 60),
            "lightGray" => imagecolorallocate($image, 200, 200, 200),
        ];

        imagefill($image, 0, 0, $palette->transparent);
        
        // 보조선 그리기
        $subCnt = 10;
        for($i = 0; $i < $subCnt; $i++){
            $y = $padding + ($height / $subCnt) * $i;
            imageline($image, $padding, $y, $padding + $width, $y, $palette->lightGray);
        }

        // 최대 기준값 구하기
        $max = 0;
        foreach($info->each as $item) $max = max($item[1], $max);
        
        $dataCnt = count($info->each);
        $barGap = ($width - ($barWidth * $dataCnt)) / ($dataCnt + 1);

        $fontPath = PUB.DS."fonts".DS."NotoSansKR.otf";
        $legendSize = 15;
        for($i = 0; $i < $dataCnt; $i++){
            // 데이터 그리기
            $x = $barGap * ($i + 1) + $barWidth * $i;
            $y = $height * $info->each[$i][1] / $max;

            $color = random_color($image);
            imagefilledrectangle($image, $padding + $x, $padding + $height, $padding + $x + $barWidth, $padding + $height - $y, $color);

            // 범례 그리기
            $legendX = $padding;
            $legendY = $padding * 1.5 + $height + $legendSize * $i * 1.3;
            imagefilledrectangle($image, $legendX, $legendY, $legendX + $legendSize, $legendY + $legendSize, $color);
            imagettftext($image, 9, 0, $legendX + $legendSize * 1.5, $legendY + $legendSize * 0.8, $palette->lightBlack, $fontPath, $info->each[$i][0]);
        }

        // X, Y축 그리기
        imageline($image, $padding, $padding, $padding, $padding + $height, $palette->lightBlack);
        imageline($image, $padding, $padding + $height, $padding + $width, $padding + $height, $palette->lightBlack);

        if($test !== ""){
            dd($test);
        }
        else {
            header("Content-Type: image/png");
            imagepng($image);
            imagedestroy($image);
        }
    }
    
    /**
     * 원 그래프 띄우기
     */
    function graphPie($type, $code){
        $info = $this->getInfo($type, $code);
        $W = 400; $H = 450;
        $textH = 200;
        $padding = 30;
        $radius = ($H - $textH - $padding * 2) / 2;
        $image = imagecreatetruecolor($W, $H);

        
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
        $result['percent'] = [];
        $countEach = DB::fetchAll("SELECT {$type} AS col, COUNT(*) AS cnt FROM accesses {$where} GROUP BY {$type} ORDER BY cnt DESC", $params);

        // 운영체제일 경우 Window, Linux, iOS, 기타로 분류해야함
        if($type === "os") {
            $required = ["Windows", "Linux", "iOS"];
            $_required = ["Windows", "Linux", "iOS"];
            foreach($countEach as $item){
                $key = array_search($item->col, $required);
                if(!in_array($item->col, $_required)) $item->col = "기타";  // 운영체제 3대장 외엔 기타로 처리
                else array_splice($required, $key, 1); // 값이 존재하면, 필요값에서 삭제
            }
            // 필요값이 남아있으면 추가 => 이 필요값은 값이 없다는 것
            foreach($required as $item){
                $countEach[] = (object)["col" => $item, "cnt" => 0];
            }
        }

        // 유입경로일 경우 상위 5개까지만 저장하고 나머지는 기타로 처리해야함.
        if($type === "referer"){
            // dd($countEach);
            $_other = array_slice($countEach, 5);
            $countEach = array_slice($countEach, 0, 5);
            $other = (object)["col" => "기타", "cnt" => 0];
            foreach($_other as $item) $other->cnt += $item->cnt;
            $countEach[] = $other;
        }

        // 퍼센트 비율 계산 / 값 정리
        foreach($countEach as $item){
            $result['each'][] = [$item->col, $item->cnt];
            $result['percent'][] = [$item->col, number_format($item->cnt * 100 / $result['all'], 2)];
        }
        
        return (object)$result;
    }
}