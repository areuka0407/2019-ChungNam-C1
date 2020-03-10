<?php
namespace Controller;

use Engine\DB;

class StatsController {
    function tablePage($code){
        $viewData['site'] = DB::fetch("SELECT * FROM sites WHERE code = ?", [$code]);
        view("table-stats", $viewData);
    }

    function graphPage($code){
        $viewData['site'] = DB::fetch("SELECT * FROM sites WHERE code = ?", [$code]);
        view("graph-stats", $viewData);
    }
}