<?php

namespace Korona\Controller;

use Korona\DB;

class BoardController extends MasterController {
    public function all() 
    {
        if(isset($_SESSION['user'])){
			$user = $_SESSION['user'];
        }else {
			$user = null;
		}

        $sql = "SELECT * FROM `tag`";
        $list = DB::fetchAll($sql, []);
        $sql3 = "SELECT * FROM `board` a, `user` b WHERE a.tag = ? and a.writer = b.id order by a.date desc ";
        
        $days = array();
        foreach($list as $key => $item) {
            ${"day".$key} = DB::fetchAll($sql3, [$item->idx]);
            
            array_push($days, ${"day".$key});
        }

        $this->render("board_all", ["user" => $user, "days"=>$days, "list" => $list]);
    }

    public function category() 
    {
        if(isset($_SESSION['user'])){
			$user = $_SESSION['user'];
        }else {
			$user = null;
		}

        $count_sql = "SELECT * FROM `tag` ORDER BY `idx` DESC LIMIT 1";
        $count = DB::fetch($count_sql, [])->idx;

        if(!isset($_GET['idx']) || $_GET['idx'] > $count || $_GET['idx'] < 1) {
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }
        
        $sql = "SELECT * FROM `tag`";
        $tags = DB::fetchAll($sql, []);

        $category = $_GET['idx'];
        
        $tag = $_GET['idx'];

        $sql1 = "SELECT a.*, b.name, (select count(*) from `liked` c where c.board_idx = a.idx) as like_cnt, (select count(*) from `views` d where d.board_idx = a.idx) as view_cnt from board a, user b where a.`tag` = ? and b.`id` = a.`writer`";
        $cnt1 = DB::fetchAll($sql1, [$category]);

        $sql2 = "SELECT * from tag WHERE `idx` = ?";
        $cnt2 = DB::fetch($sql2, [$category]);

        $sql3 = "SELECT count(*) as cnt, a.board_idx as idx, b.title from `views` a, `board` b where `category` = ? and a.board_idx = b.idx and a.date BETWEEN ? AND ? GROUP BY board_idx order by cnt desc";
        $today1 = date("Y-m-d 00:00:00");
        $today2 = date("Y-m-d 23:59:59");
        $best = DB::fetchAll($sql3, [$category, $today1, $today2]);

        $noticesql = "select * from `notice`";
        $notice = DB::fetchAll($noticesql, []);


        $cntSql = "SELECT count(*) as cnt from board where `tag` = ?";
        $total = DB::fetch($cntSql, [$category])->cnt;

        $this->render("category", ["user" => $user,"tag" => $tag,"tags" => $tags, "total" => $total, "list" => $cnt1, "category" => $cnt2->name, "best" => $best, "notice" => $notice]);
    }

    public function write()
    {
        if(isset($_SESSION['user'])){
			$user = $_SESSION['user'];
        }else {
			$user = null;
		}

        if($user == null) {
            DB::msgAndBack("로그인 후 사용해주세요.");
            exit;
        }

        if($user->islimit == 1) {
            DB::msgAndBack("회원님은 현재 관리자에 의해 활동이 제한되었습니다.");
            exit;
        }

        $category = 1;
        if(isset($_GET['category'])) {
            $category = $_GET['category'];
        }

        $list_sql = "SELECT * FROM `tag`";
        $list = DB::fetchAll($list_sql, []);

        $this->render("write", ["user" => $user, "category" => $category, "list" => $list]);

    }
    public function writeOk() 
    {
        if(isset($_SESSION['user'])){
			$user = $_SESSION['user'];
        }else {
			$user = null;
		}
        if($user == null) {
            DB::msgAndBack("로그인 후 사용해주세요.");
            exit;
        }

        $title = trim($_POST['title']);
        $tag = $_POST['category'];
        $sub = trim($_POST['sub']);
        $day = new \DateTime('now', new \DateTimeZone('Asia/Seoul'));
        $date = $day->format('Y-m-d H:i:s');
        $writer = $user->id;
        
        $link = trim($_POST['link']);
        $link_id = null;

        // null 값 체크
        if($title == "" || $tag == "" || $sub == "") {
            DB::msgAndBack("제목, 카테고리, 컨텐츠 내용 값은 비울수 없습니다.");
            exit;
        }

        // 유투브 링크 아이디 값 추출하기
        if($link != null) {
            $regExp = '/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/';
            preg_match($regExp, $link, $matches);
            if($matches == null) {
                DB::msgAndBack("유투브 링크 값 오류");
                exit;
            }
            $link_id = $matches[7];
        }

        // db 작업
       
        $sql = "INSERT INTO board(`title`, `tag`, `youtube`, `sub`, `date`, `writer`) VALUES(?,?,?,?,?,?)";
        $cnt = DB::query($sql, [$title, $tag, $link_id, $sub, $date, $writer]);

        $sql2 = "SELECT * FROM board where `writer` = ? and `date` = ?";
        $idx = DB::fetch($sql2, [$writer, $date])->idx;
        
        if(isset($_FILES['file'])){
            $file = $_FILES['file'];
        }else {
            $file = null;
        }
        if($file != null) {
            $tmp = $_FILES['file']['tmp_name'];
            foreach($tmp as $key => $value) {
                if($value != null) {
                    $path = './upload/' .time()."_".$file['name'][$key];
                    move_uploaded_file($value, $path);

                    $sql3 = "INSERT INTO board_file(`file_name`, `board_idx`) VALUES (?, ?)";
                    $cnt3 = DB::query($sql3, [$path, $idx]);
                }
            }
        }
        $usersql = "SELECT * FROM `user` WHERE `id` = ?";

        $pointsql = "UPDATE `user` SET `point` = ? WHERE `id` = ?";
        $point = $user->point;
       
        $pointSql2 = "SELECT * FROM `admin`";
        $point += DB::fetch($pointSql2, [])->write_up;

        $pointcnt = DB::query($pointsql, [$point, $user->id]);
        
        $user = DB::fetch($usersql, [$user->id]);
        $_SESSION['user'] = $user;
        
        DB::goPage("/view?idx=".$idx);

    }
    
    
    

    public function view()
    {
        if(isset($_SESSION['user'])){
			$user = $_SESSION['user'];
        }else {
			$user = null;
		}

        if(!isset($_GET['idx'])) {
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }
        
        $idx = $_GET['idx'];

        $tag_sql = "SELECT * FROM `tag`";
        $tags = DB::fetchAll($tag_sql, []);
        
        $sql = "select a.*, b.* from board a, user b where `idx` = ? and a.writer = b.id";
        $content = DB::fetch($sql, [$idx]);

        if($content == null) {
            DB::msgAndBack("삭제된 글입니다.");
            exit;
        }

        $viewSql =  "INSERT INTO `views`(`board_idx`,`date`, `category`) VALUES (?,?,?)";
        
        $day = new \DateTime('now', new \DateTimeZone('Asia/Seoul'));
        $date = $day->format('Y-m-d');

        $cnt = DB::query($viewSql, [$idx, $date, $content->tag]);

        $sql2 = "select `file_name` from board_file where `board_idx`=?";
        $imgs = DB::fetchAll($sql2, [$idx]);

        $sql3 = "SELECT count(*) as cnt FROM `liked` where board_idx = ?";
        $liked = DB::fetch($sql3, [$idx])->cnt;

        $sql4 = "SELECT count(*) as cnt FROM `views` where board_idx = ?";
        $views = DB::fetch($sql4, [$idx])->cnt;

        $islike = false;
        if($user != null) {
            $likesql = "select count(*) cnt from `liked` where `u_id` = ? and `board_idx` = ?";
            $likectn = DB::fetch($likesql, [$user->id, $idx])->cnt;
            if($likectn != 0) {
                $islike = true;
            }
        }

        
        $categorySql = "SELECT * from tag WHERE `idx` = ?";
        $category = DB::fetch($categorySql, [$content->tag]);

        $commentSql = "SELECT a.*, b.* FROM `comment` a, `user` b WHERE a.board_idx = ? and a.writer = b.id;";
        $comments = DB::fetchAll($commentSql, [$idx]);

        $commentCntSql = "SELECT count(*) as cnt FROM `comment` WHERE `board_idx` =?";
        $commentCnt = DB::fetch($commentCntSql, [$idx])->cnt;
        
        
        $pointSql = "select * from `admin`";
        $point = DB::fetch($pointSql, []);

        $searchSql = "SELECT * from board a, user b where a.idx = ? and a.writer = b.id";
        $search = DB::fetch($searchSql, [$idx]);
        $updatePoint = "update `user` set `point` = ? where `id` = ?";
        $up = $point->view_up + $search->point;
        $updatecnt = DB::query($updatePoint, [$up, $search->id]);

        $levelSql = "SELECT * FROM `level`";
        $level = DB::fetchAll($levelSql,[]);

        $this->render("view", ["user" => $user,"level"=>$level, "tags"=>$tags,"comments" => $comments,"category"=>$category->name, "commentCnt"=>$commentCnt,"content" => $content, "imgs" => $imgs, "liked" => $liked, "views" => $views, "islike" => $islike, "point" => $point]);
    }


    public function like()
    {
        if(!isset($_SESSION['user'])){
			DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }

        $user = $_SESSION['user'];
        $pointSql = "SELECT * FROM `admin`";
        $point = DB::fetch($pointSql, [])->point_level;
        if($user->point < $point) {
            DB::msgAndBack("추천하기 위해서는 $point 점 이상의 포인트가 필요합니다.");
            exit;
        }

        $writer = $_POST['writer'];

        if($user->id == $writer) {
            DB::msgAndBack("본인 글은 추천할 수 없습니다.");
            exit;
        }


        $idx = $_POST['idx'];
        $tag = $_POST['category'];

        $sql = "INSERT INTO `liked`(`u_id`, `board_idx`, `date`, `category`) VALUES (?,?,?,?)";
        
        $day = new \DateTime('now', new \DateTimeZone('Asia/Seoul'));
        $date = $day->format('Y-m-d');

        $cnt = DB::query($sql, [$user->id, $idx, $date, $tag]);

        if(!$cnt) {
            DB::msgAndBack("좋아요 실패");
            exit;
        }

        $pointSql = "select * from `admin`";
        $point = DB::fetch($pointSql, []);

        $searchSql = "SELECT * from board a, user b where a.idx = ? and a.writer = b.id";
        $search = DB::fetch($searchSql, [$idx]);
        $updatePoint = "update `user` set `point` = ? where `id` = ?";
        $up = $point->like_up + $search->point;
        $updatecnt = DB::query($updatePoint, [$up, $search->id]);

        DB::goPage("/view?idx=$idx");
        

    }

    public function unlike()
    {
        if(!isset($_SESSION['user'])){
			DB::msgAndBack("잘못된 접근입니다.");
        }

        $user = $_SESSION['user'];
        $idx = $_POST['idx'];

     
        $writer = $_POST['writer'];

        if($user->id == $writer) {
            DB::msgAndBack("본인 글은 추천할 수 없습니다.");
            exit;
        }

        $sql = "DELETE FROM `liked` WHERE `u_id` = ? and `board_idx` = ?";

        $cnt = DB::query($sql, [$user->id, $idx]);

        if(!$cnt) {
            DB::msgAndBack("좋아요 취소 실패");
            exit;
        }
        DB::goPage("/view?idx=$idx");
        

    }

    public function my() 
    {
        if(!isset($_SESSION['user'])){
			DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }

        $user = $_SESSION['user'];

        $sql = "select a.*, b.name from board a, user b where `writer` = ? and b.`id` = a.`writer`";
        $list = DB::fetchAll($sql, [$user->id]);

        $this->render("my", ["user" => $user, "list" => $list]);
    }

    public function search() 
    {
        if(isset($_SESSION['user'])){
			$user = $_SESSION['user'];
        }else {
			$user = null;
		}

        if(!isset($_GET['tag']) || !isset($_GET['contain'])){
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        
        }

        $tag = $_GET['tag'];
        $search = $_GET['contain'];

        if($tag == "writer") $tag = "name";

        $sql = "select  a.*, b.name from board a, user b where $tag like '%$search%' and b.`id` = a.`writer`";

        $list = DB::fetchAll($sql, []);
        if(!$list) {
            $list = null;
        }
        

        $this->render("search", ["user" => $user, "tag" => $tag, "search" => $search,"list"=>$list]);
    }

    public function delete()
    {
        if(!isset($_SESSION['user'])){
			
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }
		$user = $_SESSION['user'];
		
        
        $idx = $_POST['idx'];
        $tag = $_POST['tag'];

        $searchSql = "select a.*, b.name from board a, user b where `idx` = ? and a.writer = b.id";
        $searchUser = DB::fetch($searchSql, [$idx]);

        if($user->id != $searchUser->writer && $user->id != "admin") {
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }

        $deleteSql = "delete from `board` where idx = ?";
        $cnt = DB::query($deleteSql, [$idx]);

        if($cnt) {
            DB::msgAndGo("해당 글을 삭제하였습니다.", "/board/category?idx=$tag");
        }else {
            DB::msgAndBack("해당 글을 삭제하는 도중 오류 발생");
        }
    }

    public function modify()
    {
        if(isset($_SESSION['user'])){
			$user = $_SESSION['user'];
        }else {
			$user = null;
		}

        if(isset($_GET['idx'])) {
            $idx = $_GET['idx'];
        }else {
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }

        $searchSql = "select a.*, b.name from board a, user b where `idx` = ? and a.writer = b.id";
        $search = DB::fetch($searchSql, [$idx]);

        $imgSql = "select * from `board_file` where `board_idx`=?";
        $imgs = DB::fetchAll($imgSql, [$idx]);
        if(!$imgs) {
            $imgs = null;
        }
        if($user == null || $user->id != $search->writer) {
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }

        
        $this->render("modify", ["user" => $user, "list"=>$search, "imgs" => $imgs]);
    }

    public function modifyOk()
    {
        if(isset($_SESSION['user'])){
			$user = $_SESSION['user'];
        }else {
			$user = null;
		}

        $idx = $_POST['idx'];

        
        $searchSql = "select a.*, b.name from board a, user b where `idx` = ? and a.writer = b.id";
        $search = DB::fetch($searchSql, [$idx]);

        if($user == null || $user->id != $search->writer) {
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }

        $title = trim($_POST['title']);
        $tag = $_POST['category'];
        $sub = trim($_POST['sub']);
        $writer = $user->id;

        $link = trim($_POST['link']);
        $link_id = null;
       
        if(isset($_POST['imgs'])){

            $imgcheck = $_POST['imgs'];
        }else {
            $imgcheck = null;
        }
        if($imgcheck != null) {
            $imgSql = "select * from `board_file` where `board_idx`=?";
            $imgs = DB::fetchAll($imgSql, [$idx]);
            if($imgs != null) {
                foreach($imgs as $i ){
                    foreach($imgcheck as $y) {
                        if($i->idx == $y) {
                            $deleteSql = "delete from `board_file` where `idx` = ?";
                            $cnt = DB::query($deleteSql, [$y]);
                            if(!$cnt) {
                                DB::msgAndBack("사진 수정 중 오류발생");
                                exit;
                            }
                        }
                    }
                }
    
            }
            
        }
  
     
        // null 값 체크
        if($title == "" || $tag == "" || $sub == "") {
            DB::msgAndBack("제목, 카테고리, 컨텐츠 내용 값은 비울수 없습니다.");
            exit;
        }

        // 유투브 링크 아이디 값 추출하기
        if($link != null) {
            $regExp = '/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/';
            preg_match($regExp, $link, $matches);
            if($matches == null) {
                DB::msgAndBack("유투브 링크 값 오류");
                exit;
            }
            $link_id = $matches[7];
        }

        $sql = "update board set `title`=?, `tag`=?, `youtube`=?, `sub`=? where `idx` = ?";
        $cnt = DB::query($sql, [$title, $tag, $link_id, $sub, $idx]);
        if(isset($_FILES['file'])){
            $file = $_FILES['file'];
        }else {
            $file = null;
        }
        if($file != null) {
            $tmp = $_FILES['file']['tmp_name'];
            foreach($tmp as $key => $value) {
                if($value != null) {

                    $path = './upload/' .time()."_".$file['name'][$key];
                    move_uploaded_file($value, $path);
    
                    $sql3 = "INSERT INTO board_file(`file_name`, `board_idx`) VALUES (?, ?)";
                    $cnt3 = DB::query($sql3, [$path, $idx]);
                }
            }
        }

        DB::goPage("/view?idx=$idx");

    }

    public function comment()
    {
        if(!isset($_SESSION['user'])){
            DB::msgAndBack("로그인 후 이용해주시기 바랍니다.");
            exit;
        }
        $user = $_SESSION['user'];

        if($user->islimit == 1) {
            DB::msgAndBack("회원님은 현재 관리자에 의해 활동이 제한되었습니다.");
            exit;
        }
        $idx = $_POST['idx'];
        $contents = trim($_POST['contents']);
        $day = new \DateTime('now', new \DateTimeZone('Asia/Seoul'));
        $date = $day->format('Y-m-d H:i:s');

        // 공백 체크
        if($contents == "") {
            DB::msgAndBack("댓글창이 비워져있습니다.");
            exit;
        }

        if(isset($_POST['mention'])) {

            $mention = $_POST['mention'];
            $mention_id = $_POST['mention_id'];
        }else {
            $mention = null;
            $mention_id = null;
        }
        
        $point = $_POST['point'];

        $sql = "INSERT INTO comment(`writer`, `sub`,`date`,`board_idx`, `mention`, `mention_id`,`c_point`) VALUES(?,?,?,?, ?, ?,?)";
        $result = DB::query($sql, [$user->id, $contents, $date,$idx,$mention, $mention_id,$point]);
        
        $pointSql = "UPDATE `user` SET `point` = `point` + ? WHERE `id`=?";
        $pointCnt = DB::query($pointSql, [$point, $user->id]);

        if(!$result) {
            DB::msgAndBack("댓글쓰기 오류");
            exit;
        }
        DB::goPage("/view?idx=$idx");
    }

    public function commentLike()
    {
        if(!isset($_SESSION['user'])){
            DB::msgAndBack("로그인 후 이용해주시기 바랍니다.");
            exit;
        }
        $user = $_SESSION['user'];
        $pointSql = "SELECT * FROM `admin`";
        $point = DB::fetch($pointSql, [])->point_level;
        if($user->point < $point) {
            DB::msgAndBack("추천하기 위해서는 $point 점 이상의 포인트가 필요합니다.");
            exit;
        }

        if(!isset($_GET['idx'])){
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }

        

        $idx = $_GET['idx'];

        $checkSql = "SELECT * FROM `comment_like` where `u_id` = ? and `comment_idx` = ?";
        $check = DB::fetch($checkSql, [$user->id, $idx]);

        if($check == null) {
            $updateSql = "UPDATE `comment` SET `like_cnt` = `like_cnt` +1 WHERE idx = ?";
            $updateCtn = DB::query($updateSql, [$idx]);
            $insertSql = "INSERT INTO comment_like(`comment_idx`, `u_id`) VALUES(?,?)";
            $insertCnt = DB::query($insertSql, [$idx, $user->id]);
            if(!$updateCtn || !$insertCnt) {
                DB::msgAndBack("댓글 공감하기 오류");
                exit;
            }else {
                DB::msgAndBack("해당 댓글에 공감하였습니다.");
            }
        }else {
            DB::msgAndBack("이미 해당 댓글에 공감하였습니다.");
        }
         
    }

    public function bestDaily()
    {
        if(!isset($_SESSION['user'])){
            $user = null;
        }else {
            $user = $_SESSION['user'];
        }
        
        
        date_default_timezone_set('Asia/Seoul');
        $sql = "SELECT count(*) as cnt, a.board_idx as idx, b.* from `views` a, `board` b where `category` = ? and a.board_idx = b.idx and a.date BETWEEN ? AND ? GROUP BY board_idx order by cnt desc";
        $today1 = date("Y-m-d 00:00:00");
        $today2 = date("Y-m-d 23:59:59");

        $tag_sql = "SELECT * FROM `tag`";
        $tags = DB::fetchAll($tag_sql, []);
        
        $list = array();
        foreach($tags as $key => $item) {
            ${"day".$key} = DB::fetchAll($sql, [$item->idx, $today1, $today2]);
            array_push($list, ${"day".$key});
        }


        $when = "일간";

        $this->render("best", ["user" => $user, "list" => $list, "when" => $when, "tags" => $tags]);

    }

    public function bestWeekend()
    {
        if(!isset($_SESSION['user'])){
            $user = null;
        }else {
            $user = $_SESSION['user'];
        }
        
        
        date_default_timezone_set('Asia/Seoul');
        $sql = "SELECT count(*) as cnt, a.board_idx as idx, b.* from `views` a, `board` b where `category` = ? and a.board_idx = b.idx and a.date BETWEEN ? AND ? GROUP BY board_idx order by cnt desc";
       
        $today2 = date("Y-m-d 23:59:59");
        
        $timestamp = strtotime("-1 week");
        $weekend = date("Y-M-D 00:00:00", $timestamp);

        $tag_sql = "SELECT * FROM `tag`";
        $tags = DB::fetchAll($tag_sql, []);
        
        $list = array();
        foreach($tags as $key => $item) {
            ${"day".$key} = DB::fetchAll($sql, [$item->idx, $weekend, $today2]);
            array_push($list, ${"day".$key});
        }


        $when = "주간";

        $this->render("best", ["user" => $user, "list" => $list, "when" => $when, "tags" => $tags]);

    }

    public function bestMonth()
    {
        if(!isset($_SESSION['user'])){
            $user = null;
        }else {

            $user = $_SESSION['user'];
        }
        
        date_default_timezone_set('Asia/Seoul');
        $sql = "SELECT count(*) as cnt, a.board_idx as idx, b.* from `views` a, `board` b where `category` = ? and a.board_idx = b.idx and a.date BETWEEN ? AND ? GROUP BY board_idx order by cnt desc";
        
        $today2 = date("Y-m-d 23:59:59");
        
        $timestamp = strtotime("-1 months");
        $month = date("Y-M-D 00:00:00", $timestamp);

        $tag_sql = "SELECT * FROM `tag`";
        $tags = DB::fetchAll($tag_sql, []);
        
        $list = array();
        foreach($tags as $key => $item) {
            ${"day".$key} = DB::fetchAll($sql, [$item->idx, $month, $today2]);
            array_push($list, ${"day".$key});
        }
    

        $when = "월간";

        $this->render("best", ["user" => $user, "list" => $list, "when" => $when, "tags" => $tags]);
    }

    public function reportBoard()
    {
        if(!isset($_SESSION['user'])){
            DB::msgAndBack("로그인 후 이용바랍니다.");
            exit;
        }

        $user = $_SESSION['user'];

        if(isset($_GET['idx'])){
            $idx = $_GET['idx'];
        }else {
            $idx = null;
        }
        
        if($idx == null || $idx == ""){
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }
        
        $day = new \DateTime('now', new \DateTimeZone('Asia/Seoul'));
        $date = $day->format('Y-m-d H:i:s');
        $sql = "INSERT INTO `report_board`(`board_idx`, `reporter`, `date`) VALUES (?, ?, ?)";
        $cnt = DB::query($sql, [$idx, $user->id, $date]);
        
        if(!$cnt) {
            DB::msgAndBack("해당 글 신고 실패");
        }else {
            DB::msgAndBack("해당 글 신고 성공");
        }
    }

    public function reportComment()
    {

        if(!isset($_SESSION['user'])){
            DB::msgAndBack("로그인 후 이용바랍니다.");
            exit;
        }

        $user = $_SESSION['user'];

        if(isset($_GET['idx'])){
            $idx = $_GET['idx'];
        }else {
            $idx = null;
        }
        
        if($idx == null || $idx == ""){
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }
        
        $day = new \DateTime('now', new \DateTimeZone('Asia/Seoul'));
        $date = $day->format('Y-m-d H:i:s');
        $sql = "INSERT INTO `report_comment`(`comment_idx`, `reporter`, `date`) VALUES (?, ?, ?)";
        $cnt = DB::query($sql, [$idx, $user->id, $date]);
        
        if(!$cnt) {
            DB::msgAndBack("해당 댓글 신고 실패");
        }else {
            DB::msgAndBack("해당 댓글 신고 성공");
        }
    }

    public function categoryUpdate()
    {
        if(!isset($_SESSION['user'])){
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }
        $user = $_SESSION['user'];
        if($user->id != 'admin') {
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }

        $idx = $_POST['idx'];
        $name = $_POST['name'];
        $sql = "UPDATE `tag` SET `name`= ? where `idx` = ?";
        $cnt = DB::query($sql, [$name, $idx]);
        if(!$cnt){
            DB::msgAndBack("카테고리 제목 수정에 실패하였습니다.");
            exit;
        }
        DB::goBack();
    }

    public function categoryDelete()
    {
        if(!isset($_SESSION['user'])){
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }
        $user = $_SESSION['user'];
        if($user->id != 'admin') {
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }
        $idx = $_POST['idx'];
        $tag_sql = "DELETE FROM `tag` WHERE `idx`= ?";
        $board_sql = "DELETE FROM `board` where `tag` = ?";
        $tag_cnt = DB::query($tag_sql,[$idx]);
        $board_cnt = DB::query($board_sql, [$idx]);
        if(!$tag_cnt || !$board_cnt){
            DB::msgAndBack("카테고리 삭제가 실패하였습니다.");
            exit;
        }
        DB::goBack();
    }

    public function categoryAdd()
    {
        if(!isset($_SESSION['user'])){
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }
        $user = $_SESSION['user'];
        if($user->id != 'admin') {
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }
        $name = $_POST['name'];
        $tag_sql = "INSERT INTO`tag`(`name`) VALUES (?)";
        $tag_cnt = DB::query($tag_sql, [$name]);
        if(!$tag_cnt){
            DB::msgAndBack("카테고리 추가가 실패하였습니다.");
            exit;
        }
        DB::goBack();
    }
}
