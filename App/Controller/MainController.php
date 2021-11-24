<?php

namespace Korona\Controller;

use Korona\DB;

class MainController extends MasterController {

	public function home()
	{	
		if(isset($_SESSION['user'])){
			$user = $_SESSION['user'];
        }else {
			$user = null;
		}
		date_default_timezone_set('Asia/Seoul');

		$sql = "SELECT count(*) as cnt, a.board_idx as idx, b.* from `views` a, `board` b where `category` = ? and a.board_idx = b.idx and a.date BETWEEN ? AND ? GROUP BY board_idx order by cnt desc";
        $today1 = date("Y-m-d 00:00:00");
        $today2 = date("Y-m-d 23:59:59");
        $day1 = DB::fetchAll($sql, [1, $today1, $today2]);
        $day2 = DB::fetchAll($sql, [2, $today1, $today2]);
        $day3 = DB::fetchAll($sql, [3, $today1, $today2]);
        $day4 = DB::fetchAll($sql, [4, $today1, $today2]);
        $day5 = DB::fetchAll($sql, [5, $today1, $today2]);
		$days = array($day1, $day2, $day3, $day4, $day5);

		$timestamp = strtotime("-1 week");
		$weekend = date("Y-M-D 00:00:00", $timestamp);

		$weekend1 = DB::fetchAll($sql, [1, $weekend, $today2]);
        $weekend2 = DB::fetchAll($sql, [2, $weekend, $today2]);
        $weekend3 = DB::fetchAll($sql, [3, $weekend, $today2]);
        $weekend4 = DB::fetchAll($sql, [4, $weekend, $today2]);
        $weekend5 = DB::fetchAll($sql, [5, $weekend, $today2]);
		$weekends = array($weekend1, $weekend2, $weekend3, $weekend4, $weekend5);

		$timestamp = strtotime("-1 months");
		$month = date("Y-M-D 00:00:00", $timestamp);

		$month1 = DB::fetchAll($sql, [1, $month, $today2]);
        $month2 = DB::fetchAll($sql, [2, $month, $today2]);
        $month3 = DB::fetchAll($sql, [3, $month, $today2]);
        $month4 = DB::fetchAll($sql, [4, $month, $today2]);
        $month5 = DB::fetchAll($sql, [5, $month, $today2]);
		$months = array($month1, $month2, $month3, $month4, $month5);
		
		$noticeSql = "select * from `notice`";
		$notice = DB::fetchAll($noticeSql, []);

        $this->render("main", ["user" => $user, "days" => $days, "weekends" => $weekends, "months" => $months, "notice" => $notice]);
	}
	
}