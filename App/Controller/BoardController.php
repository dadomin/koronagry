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

        $sql3 = "SELECT count(*) as cnt, a.board_idx as idx, b.* from `views` a, `board` b where `category` = ? and a.board_idx = b.idx and a.date BETWEEN ? AND ? GROUP BY board_idx order by cnt desc";
        $today1 = date("Y-m-d 00:00:00");
        $today2 = date("Y-m-d 23:59:59");
        $day1 = DB::fetchAll($sql3, [1, $today1, $today2]);
        $day2 = DB::fetchAll($sql3, [2, $today1, $today2]);
        $day3 = DB::fetchAll($sql3, [3, $today1, $today2]);
        $day4 = DB::fetchAll($sql3, [4, $today1, $today2]);
        $day5 = DB::fetchAll($sql3, [5, $today1, $today2]);

        $this->render("board_all", ["user" => $user, "day1" => $day1, "day2" => $day2, "day3" => $day3, "day4" => $day4, "day5" => $day5]);
    }

    public function category() 
    {
        if(isset($_SESSION['user'])){
			$user = $_SESSION['user'];
        }else {
			$user = null;
		}

        if(!isset($_GET['idx']) || $_GET['idx'] > 5 || $_GET['idx'] < 1) {
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }

        $category = $_GET['idx'];
        
        $tag = $_GET['idx'];

        $sql1 = "SELECT a.*, b.name from board a, user b where a.`tag` = ? and b.`id` = a.`writer`";
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

        $this->render("category", ["user" => $user,"tag" => $tag, "total" => $total, "list" => $cnt1, "category" => $cnt2->name, "best" => $best, "notice" => $notice]);
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

        $this->render("write", ["user" => $user]);

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
        $point += 10;

        $pointcnt = DB::query($pointsql, [$point, $user->id]);
        
        $user = DB::fetch($usersql, [$user->id]);
        $_SESSION['user'] = $user;
        
        DB::msgAndGo("글 추가 성공","/view?idx=".$idx);

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

        
        $sql = "select a.*, b.name from board a, user b where `idx` = ? and a.writer = b.id";
        $content = DB::fetch($sql, [$idx]);

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
        

        $this->render("view", ["user" => $user, "content" => $content, "imgs" => $imgs, "liked" => $liked, "views" => $views, "islike" => $islike]);
    }


    public function like()
    {
        if(!isset($_SESSION['user'])){
			DB::msgAndBack("잘못된 접근입니다.");
        }

        $user = $_SESSION['user'];
        if($user->point < 30) {
            DB::msgAndBack("추천하기 위해서는 30점 이상의 포인트가 필요합니다.");
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
        }else {
            DB::msgAndGo("좋아요 성공", "/view?idx=$idx");
        }

    }

    public function unlike()
    {
        if(!isset($_SESSION['user'])){
			DB::msgAndBack("잘못된 접근입니다.");
        }

        $user = $_SESSION['user'];
        $idx = $_POST['idx'];

        $sql = "DELETE FROM `liked` WHERE `u_id` = ? and `board_idx` = ?";

        $cnt = DB::query($sql, [$user->id, $idx]);

        if(!$cnt) {
            DB::msgAndBack("좋아요 취소 실패");
        }else {
            DB::msgAndGo("좋아요 취소 성공", "/view?idx=$idx");
        }

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
        if(isset($_SESSION['user'])){
			$user = $_SESSION['user'];
        }else {
			$user = null;
		}
        
        $idx = $_POST['idx'];
        $tag = $_POST['tag'];

        $searchSql = "select a.*, b.name from board a, user b where `idx` = ? and a.writer = b.id";
        $searchUser = DB::fetch($searchSql, [$idx]);

        if($user == null || $user->id != $searchUser->writer) {
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

        DB::msgAndGo("수정 완료", "/view?idx=$idx");

    }
}
