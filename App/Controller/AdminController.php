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
        $pointSql = "select * from `admin`";
        $point = DB::fetch($pointSql, []);


        $this->render("member", ["user" => $user, "list" => $list,"point"=>$point]);
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

        DB::goPage("/notice");
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
        
        $sql = "SELECT * FROM `tag`";
        $tags = DB::fetchAll($sql, []);
        $this->render("notice_view", ["content" => $content, "user" => $user,"tags"=>$tags]);
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
            DB::goPage("/notice");
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

        DB::goPage("/notice/view?idx=$idx");
    }

    public function givePoint()
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

        if(isset($_POST['point'])){
            $point = $_POST['point'];
        }else {
            $point = null;
        }

        if($point == null || $point == 0){
            DB::msgAndGo("지급할 포인트 점수를 입력해주세요.", "/member");
            exit;
        }

        if(!isset($_POST['id'])){
            DB::msgAndBack("포인트를 지급할 대상을 선택해 주세요.");
            exit;
        }
        $ids = $_POST['id'];
        if(empty($ids)){
            DB::msgAndBack("포인트를 지급할 대상을 선택해 주세요.");
            exit;
        }

        $way = $_POST['way'];

        if($way == "plus") {
            foreach($ids as $id){
                $sql = "update `user` set `point` =`point`+ ? where `id` = ?";
                $cnt = DB::query($sql, [$point, $id]);
                if(!$cnt) {
                    DB::msgAndGo("포인트 지급 중 오류 발생", "/member");
                    exit;
                }
            }
        }else {
            foreach($ids as $id){
                $sql = "update `user` set `point` =`point`- ? where `id` = ?";
                $cnt = DB::query($sql, [$point, $id]);
                if(!$cnt) {
                    DB::msgAndGo("포인트 회수 중 오류 발생", "/member");
                    exit;
                }
            }
        }

        

        DB::goPage("/member");
    }

    public function pointLevel()
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
        if(isset($_POST['point'])){
            $point = $_POST['point'];
        }else {
            $point = null;
        }

        if($point == null || $point == 0){
            DB::msgAndBack("변경할 포인트 점수를 입력해주세요.");
            exit;
        }

        $sql = "UPDATE `admin` SET `point_level` = ? where 1";
        $cnt = DB::query($sql, [$point]);

        if(!$cnt){
            DB::msgAndBack("좋아요 기능 포인트 점수 조정 중 오류 발생");
            exit;
        }

        DB::goPage("레벨 조정을 완료하였습니다.", "/admin/point");
    }

    public function levelGrade()
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
        if(isset($_POST['grade'])){
            $grade = $_POST['grade'];
        }else {
            $grade = null;
        }

        if($grade == null || $grade == 0){
            DB::msgAndBack("변경할 포인트 점수를 입력해주세요.");
            exit;
        }

        $sql = "UPDATE `admin` SET `level_grade` = ? where 1";
        $cnt = DB::query($sql, [$grade]);

        if(!$cnt){
            DB::msgAndBack("레벨당 포인트 기준 점수 조정 중 오류 발생");
            exit;
        }

        DB::goPage("/member");
    }

    public function category()
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

        $sql = "SELECT a.*, (select count(*) from `board` where tag = a.idx) as cnt FROM `tag` a";
        $list = DB::fetchAll($sql, []);

        $this->render("admin_category", ["user"=>$user, "list"=>$list]);
    }

    public function blind()
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

        
        if(isset($_GET['idx'])){
            $idx = $_GET['idx'];
        }else {
            $idx = null;
        }

        if($idx == null || $idx == ""){
            DB::msgAndBack("해당 글이 존재하지 않습니다.");
            exit;
        }

        $sql = "UPDATE `board` SET `blind`= 1 WHERE `idx` = ?";
        $cnt = DB::query($sql, [$idx]);
        if(!$cnt) {
            DB::msgAndBack("오류 발생");
            exit;
        }
        DB::msgAndBack("블라인드 처리 완료");
        


    }

    public function show() {
        if(!isset($_SESSION['user'])){
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }
        $user = $_SESSION['user'];
        if($user->id != 'admin') {
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }

        
        if(isset($_GET['idx'])){
            $idx = $_GET['idx'];
        }else {
            $idx = null;
        }

        if($idx == null || $idx == ""){
            DB::msgAndBack("해당 글이 존재하지 않습니다.");
            exit;
        }

        $sql = "UPDATE `board` SET `blind`= 0 WHERE `idx` = ?";
        $cnt = DB::query($sql, [$idx]);
        if(!$cnt) {
            DB::msgAndBack("오류 발생");
            exit;
        }
        DB::goBack();
    }

    public function limit()
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

        $id = $_POST['id'];
        $sql = "UPDATE `user` SET `islimit` = 1 WHERE id = ?";
        $cnt = DB::query($sql, [$id]);
        if(!$cnt) {
            DB::msgAndBack("오류 발생");
            exit;
        }
        DB::goBack();
    }

    public function limit_none()
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

        $id = $_POST['id'];
        $sql = "UPDATE `user` SET `islimit` = 0 WHERE id = ?";
        $cnt = DB::query($sql, [$id]);
        if(!$cnt) {
            DB::msgAndBack("오류 발생");
            exit;
        }
        DB::goBack();
    }

    public function reportAll()
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
        
        $boardSql = "SELECT a.*, b.name, c.title FROM `report_board` a, `user` b, `board` c where a.reporter = b.id and a.board_idx = c.idx";
        $board = DB::fetchAll($boardSql, []);
        $commentSql = "SELECT a.*, b.name, c.board_idx, c.sub FROM `report_comment` a, `user` b, `comment` c where a.reporter = b.id and a.comment_idx = c.idx";
        $comment = DB::fetchAll($commentSql, []);

        $this->render("report", ["user" => $user, "board" => $board, "comment" => $comment]);
    }


    public function registerPoint()
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
        if(isset($_POST['point'])){
            $point = $_POST['point'];
        }else {
            $point = null;
        }

        if($point == null || $point == 0){
            DB::msgAndGo("포인트 점수를 입력해주세요.", "/admin/point");
            exit;
        }

        $sql = "update `admin` set `register_up` = ?";
        $cnt = DB::query($sql, [$point]);

        if(!$cnt) {
            DB::msgAndBack("오류가 발생하였습니다. 다시 시도해주세요.");
            exit;
        }

        DB::goPage("/admin/point");
    }

    public function loginPoint()
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
        if(isset($_POST['point'])){
            $point = $_POST['point'];
        }else {
            $point = null;
        }

        if($point == null || $point == 0){
            DB::msgAndGo("포인트 점수를 입력해주세요.", "/admin/point");
            exit;
        }

        $sql = "update `admin` set `login_up` = ?";
        $cnt = DB::query($sql, [$point]);

        if(!$cnt) {
            DB::msgAndBack("오류가 발생하였습니다. 다시 시도해주세요.");
            exit;
        }

        DB::goPage("/admin/point");
    }

    public function writePoint()
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
        if(isset($_POST['point'])){
            $point = $_POST['point'];
        }else {
            $point = null;
        }

        if($point == null || $point == 0){
            DB::msgAndGo("포인트 점수를 입력해주세요.", "/admin/point");
            exit;
        }

        $sql = "update `admin` set `write_up` = ?";
        $cnt = DB::query($sql, [$point]);

        if(!$cnt) {
            DB::msgAndBack("오류가 발생하였습니다. 다시 시도해주세요.");
            exit;
        }

        DB::goPage("/admin/point");
    }

    public function viewPoint()
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
        if(isset($_POST['point'])){
            $point = $_POST['point'];
        }else {
            $point = null;
        }

        if($point == null || $point == 0){
            DB::msgAndGo("포인트 점수를 입력해주세요.", "/admin/point");
            exit;
        }

        $sql = "update `admin` set `view_up` = ?";
        $cnt = DB::query($sql, [$point]);

        if(!$cnt) {
            DB::msgAndBack("오류가 발생하였습니다. 다시 시도해주세요.");
            exit;
        }

        DB::goPage("/admin/point");
    }

    public function likePoint()
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
        if(isset($_POST['point'])){
            $point = $_POST['point'];
        }else {
            $point = null;
        }

        if($point == null || $point == 0){
            DB::msgAndGo("포인트 점수를 입력해주세요.", "/admin/point");
            exit;
        }

        $sql = "update `admin` set `like_up` = ?";
        $cnt = DB::query($sql, [$point]);

        if(!$cnt) {
            DB::msgAndBack("오류가 발생하였습니다. 다시 시도해주세요.");
            exit;
        }

        DB::goPage("/admin/point");
    }

    public function point()
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

        $sql = "select * from `level`";
        $list = DB::fetchAll($sql, []);
        $pointSql = "select * from `admin`";
        $point = DB::fetch($pointSql, []);


        $this->render("point", ["user" => $user, "list"=>$list,"point"=>$point]);
    }

    public function levelMax() 
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
        if(isset($_POST['level'])){
            $level = $_POST['level'];
        }else {
            $level = null;
        }

        if($level == null || $level == 0){
            DB::msgAndGo("최고 레벨을 입력해주세요.", "/admin/point");
            exit;
        }

        $sql = "update `admin` set `level_max` = ?";
        $cnt = DB::query($sql, [$level]);

        if(!$cnt) {
            DB::msgAndBack("오류가 발생하였습니다. 다시 시도해주세요.");
            exit;
        }

        DB::goPage("/admin/point");
    }

    public function levelModify()
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
        if(isset($_POST['point'])){
            $point = $_POST['point'];
        }else {
            $point = null;
        }

        if($point == null || $point == 0){
            DB::msgAndGo("포인트 점수를 입력해주세요.", "/admin/point");
            exit;
        }
        $level = $_POST['level'];

        $sql = "UPDATE `level` set `point` = ? where `level` = ?";
        $cnt = DB::query($sql, [$point, $level]);
        if(!$cnt) {
            DB::msgAndBack("오류가 발생하였습니다. 다시 시도해주시기 바랍니다.");
            exit;
        }
        DB::goPage("/admin/point");
    }

    public function test()
    {
        
        for($i = 1; $i < 105; $i++) {
            $sql = "INSERT INTO `level`(`level`,`point`) VALUES(?,?)";
            $cnt = DB::query($sql,[$i, $i*100]);
            
        }
    }

}