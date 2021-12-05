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

		// $sql = "SELECT count(*) as cnt, a.board_idx as idx, b.* from `views` a, `board` b where `category` = ? and a.board_idx = b.idx and a.date BETWEEN ? AND ? GROUP BY board_idx order by cnt desc";
		
	
		// $sql1 = "SELECT * FROM `board_file` a, board b, user c where a.board_idx = b.idx and b.writer = c.id GROUP by a.board_idx order by b.date desc;"
		// 최신글
		$recentSql = "SELECT *, (select file_name from board_file where board_idx = a.idx group by board_idx) as img FROM `board` a, `user` b WHERE a.writer = b.id order by a.date desc";
		$recent = DB::fetchAll($recentSql, []);

		// 댓글 많은 글
        $replySql = "SELECT count(*) as cnt, b.*,c.*,(select file_name from board_file where board_idx = b.idx group by board_idx) as img FROM `comment` a, `board` b, `user` c where a.board_idx = b.idx and b.writer = c.id GROUP by a.board_idx order by cnt desc";
		$reply = DB::fetchAll($replySql, []);

		// 사진 글
		$imgSql = "SELECT a.file_name, b.*, c.* FROM `board_file` a, board b, user c where a.board_idx = b.idx and b.writer = c.id GROUP by a.board_idx order by b.date desc";
		$img = DB::fetchAll($imgSql, []);

		// 영상 글
		$videoSql = "SELECT * FROM `board` a, `user` b where a.writer = b.id and a.youtube is not null order by a.date desc";
		$video = DB::fetchAll($videoSql, []);

		// 베스트 댓글
		$bestReplySql = "SELECT *, (select count(*) from `comment_like` where comment_idx = a.idx) as cnt FROM `comment` a, `user` b where a.writer = b.id order by cnt desc";
		$bestReply = DB::fetchAll($bestReplySql, []);

		// 실시간 댓글
		$liveReplySql = "SELECT *, (select count(*) from `comment_like` where comment_idx = a.idx) as cnt FROM `comment` a, `user` b where a.writer = b.id order by date desc";
		$liveReply = DB::fetchAll($liveReplySql, []);

		// 공지글
		$noticeSql = "select * from `notice`";
		$notice = DB::fetchAll($noticeSql, []);

        $this->render("main", ["user" => $user, "recent" => $recent, "reply"=> $reply, "img" => $img, "video" => $video, "bestReply" => $bestReply, "liveReply" => $liveReply,  "notice" => $notice]);
	}
	
}