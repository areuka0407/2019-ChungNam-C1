# 2019-ChungNam-C1
2019년도 충남 - C과제 (try 1)


새로 알게된 정보

1. 세션의 유지시간을 정하는 함수가 존재한다.

        session_cache_expire(Number $minutes)


    위 함수는 세션의 유지시간을 분 단위로 정할 수 있는 함수이다.
    이를 통해 N시간 동안 접속이 없으면 자동 로그아웃 되는 등의 기능을 구현할 수 있다.


2. 현재 접속한 유저의 접속 정보를 확인하는 함수


        function browserInfo(){
            $u_agent = $_SERVER['HTTP_USER_AGENT'];
            $browser = $o_system = $version = "Unknown";
            
            // 운영체제 확인
            if(preg_match("/linux/i", $u_agent)) $o_system = "Linux";

            else if(preg_match("/macintosh|mac os x/i", $u_agent)) $o_system = "Mac";
            
            else if(preg_match("/windows|win32/i", $u_agent)) $o_system = "Windows";

            // 브라우저 확인
            if(preg_match("/MSIE/i", $u_agent) && !preg_match("/Opera/i", $u_agent)) 
            { $browser = "IE"; $base = "MSIE"; }
            else if(preg_match("/Firefox/i", $u_agent))
            { $browser = "Firefox"; $base = "Firefox"; }
            else if(preg_match("/OPR/i", $u_agent))
            { $browser = "Opera"; $base = "Opera"; }
            else if(preg_match("/Whale/i", $u_agent)){ $browser = "Whale"; $base = "Whale"; }
            else if(preg_match("/Chrome/i", $u_agent) && !preg_match("/Edge/i", $u_agent))
            { $browser = "Chrome"; $base = "Chrome"; }
            else if(preg_match("/Safari/i", $u_agent) && !preg_match("/Edge/i", $u_agent))
            { $browser = "Safari"; $base = "Safari"; }
            else if(preg_match("/Netscape/i", $u_agent))
            { $browser = "Netscape"; $base = "Netscape"; }
            else if(preg_match("/Edge/i", $u_agent))
            { $browser = "Edge"; $base = "Edge"; }
            else if(preg_match("/Trident/i", $u_agent))
            { $browser = "IE"; $base = "MSIE"; }

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

    HTTP의 User-Agent를 가져올 수 있다면 위 코드를 응용해서 완성할 수 있을 것 같다.


3. PHP 에서 이미지의 투명도를 유지하고 PNG 로 저장하는 방법
        
    지금까지는 왜 PNG에 'imagecolorallocatealpha'를 사용해도 투명도가 유지되지 않는 지 모른채 넘어갔는데, 이번 기회에 확실히 하고 가자고 생각한다.

        $image = imagecreatetruecolor(500, 500);
        imagesavealpha($image, true); // 이미지의 투명도를 유지할 지의 여부
        $background = imagecolorallocatealpha($image, 255, 255, 255, 127); // 투명한 배경색
        imagefill($image, 0, 0, $background);

    위와 같이 사용하면 투명한 배경을 가진 이미지를 만들 수 있다. 기존에 착각했던 점이 두 가지가 있었는데...
    1. 'imagesavealpha'를 사용하지 않으면 PNG 파일이라도 투명도가 유지되지 않는다는 점.
    2. imagecolorallocatealpha의 5번째 인자인 'alpha' 값은 0~127 사이의 투명도 값이 들어가야 하는데, 이는 '불투명도'가 아니라 '투명도' 이기 때문에 값이 커질 수록 투명해진다는 점.

    두번째 이유가 가장 어이없다... 다음부턴 주의하도록 하자.