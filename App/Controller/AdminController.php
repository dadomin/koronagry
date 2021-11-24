<?php

namespace Korona\Controller;

use Korona\DB;

class AdminController extends MasterController {

    public function member()
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

        $sql = "select * from `user`";
        $list = DB::fetchAll($sql, []);
        $this->render("member", ["user" => $user, "list" => $list]);
    }

    public function deletemember() {
        if(!isset($_SESSION['user'])){
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }
        $user = $_SESSION['user'];
        if($user->id != 'admin') {
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }
        $id = $_POST['id'];
        $sql = "delete from `user` where id = ?";
        $list = DB::query($sql, [$id]);
        DB::msgAndGo("회원 삭제 완료", "/member");
    }

    public function notice() {
        
        if(!isset($_SESSION['user'])){$user = null;}else {$user = $_SESSION['user'];}

        $sql = "select * from `notice`";
        $list = DB::fetchAll($sql, []);

        $totalSql = "select count(*) as cnt from `notice`";
        $total = DB::fetch($totalSql,[])->cnt;

        $this->render("notice", ["user"=>$user, "list"=>$list, "total" => $total]);
    }

    public function noticewrite()
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

        $this->render("notice_write", ["user" => $user]);
    }

    public function noticeok() 
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

        $title = $_POST['title'];
        $sub = $_POST['sub'];
        $day = new \DateTime('now', new \DateTimeZone('Asia/Seoul'));
        $date = $day->format('Y-m-d H:i:s');

        $sql = "insert into `notice`(`title`, `sub`, `date`) values(?,?,?)";
        $cnt = DB::query($sql, [$title, $sub, $date]);

        DB::msgAndGo("공지글 추가 성공","/");
    }

    public function view() 
    {
        if(isset($_SESSION['user'])){
			$user = $_SESSION['user'];
        }else {
			$user = null;
		}

        if(!isset($_GET['idx'])){
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }
        $idx = $_GET['idx'];
        $sql = "select * from `notice` where `idx` = ?";
        $content = DB::fetch($sql, [$idx]);
        $this->render("notice_view", ["content" => $content, "user" => $user]);
    }

    public function noticemodify() 
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

        if(isset($_GET['idx'])) {
            $idx = $_GET['idx'];
        }else {
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }

        $searchSql = "select * from notice a where `idx` = ? ";
        $search = DB::fetch($searchSql, [$idx]);

        
        $this->render("notice_modify", ["user" => $user, "list"=>$search]);
    }

    public function noticedelete() 
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

        $deleteSql = "delete from `notice` where idx = ?";
        $cnt = DB::query($deleteSql, [$idx]);

        if($cnt) {
            DB::msgAndGo("해당 공지글을 삭제하였습니다.", "/notice");
        }else {
            DB::msgAndBack("해당 공지글을 삭제하는 도중 오류 발생");
        }
    }

    public function noticeModifyOk()
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

        $title = $_POST['title'];
        $sub = $_POST['sub'];
        $idx = $_POST['idx'];

        $sql = "UPDATE `notice` SET `title` = ?, `sub`=? where `idx` = ?";
        $cnt = DB::query($sql, [$title, $sub,  $idx]);

        DB::msgAndGo("공지글 수정 성공","/notice/view?idx=$idx");
    }
}