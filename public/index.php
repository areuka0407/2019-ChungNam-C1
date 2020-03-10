<?php
session_cache_expire(60 * 2); // 2시간 세션 유지
session_start();

define("DS", DIRECTORY_SEPARATOR);
define("ROOT", dirname(__DIR__));
define("SRC", ROOT.DS."src");
define("PUBLIC", ROOT.DS."public");
define("VIEWS", SRC.DS."Views");


require SRC.DS."autoload.php";
require SRC.DS."helper.php";
require SRC.DS."web.php";