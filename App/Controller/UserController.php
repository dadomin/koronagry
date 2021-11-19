<?php

namespace Korona\Controller;

use Korona\DB;

class UserController extends MasterController {

	public function login()
	{	
		if(isset($_SESSION['user'])){
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }


        $this->render("login", []);
	}

    public function logcheck() 
    {
        // 로그인 되어있는지 체크
        if(isset($_SESSION['user'])){
            DB::msgAndBack("로그아웃 후 이용해주시기 바랍니다.");
            exit;
        }

        $id = $_POST['id'];
        $pw = $_POST['pw'];
        
         // 해당란이 비워져있는지 체크
        if($id == "" || $pw == "") {
            DB::msgAndBack("필수입력란이 비워져 있습니다.");
            exit;
        }

        $sql = "SELECT * FROM `user` WHERE `id` = ? AND `pw` = ?";
        $user = DB::fetch($sql, [$id, $pw]);

        if(!$user) {
            DB::msgAndBack("로그인 실패");
            exit;
        }

        $sql2 = "UPDATE `user` SET `point` = ? WHERE `id` = ?";
        $point = $user->point;
        $point += 10;
        $cnt = DB::query($sql2, [$point, $id]);

        $user = DB::fetch($sql, [$id, $pw]);
        $_SESSION['user'] = $user;

        DB::msgAndGo("{$user->name}님 로그인되었습니다.", "/");

    }
    public function logout() 
    {
        
        if(!isset($_SESSION['user'])){
            DB::msgAndBack("로그인 후 이용해주시기 바랍니다.");
            exit;
        }

        unset($_SESSION['user']);
        DB::msgAndGo("로그아웃 되었습니다.", "/");
    }

    public function register()
    {
        if(isset($_SESSION['user'])) {
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }

        $this->render("register", []);
    }

    public function regicheck() 
    {
        // 로그인 되어있는지 체크
        if(isset($_SESSION['user'])){
            DB::msgAndBack("로그아웃 후 이용해주시기 바랍니다.");
            exit;
        }

        $id = trim($_POST['id']);
        $name = trim($_POST['name']);
        $pass = trim($_POST['pw']);
        $cpass = trim($_POST['pwcheck']);
        $file = $_FILES['file'];

        // 비어있는지 체크
        if($id == "" || $name == "" || $pass == "" || $cpass == "" ) {
            DB::msgAndBack("필수입력란이 비어져있습니다. 모든 항목이 필수 입력란입니다.");
            exit;
        }

        // 회원가입된 회원있는지 체크
        $sql1 = "SELECT COUNT(*) AS cnt FROM `user`";
        $cnt1 = DB::fetch($sql1, [])->cnt;

        // 회원이 있을경우 아이디&닉네임 겹치는지 체크
        if($cnt1 != 0) {
            $sql2 = "SELECT * FROM `user` where id = ?";
            $cnt2 = DB::fetch($sql2, [$id]);
            if($cnt2) {
                DB::msgAndBack("해당 아이디가 이미 등록되어있습니다.");
                exit;
            } 
        }

        //이미지 파일인지 체크
        if(explode("/", $file['type'])[0] != "image") {
            DB::msgAndBack("이미지 파일만 업로드 가능합니다.");
            exit;
        }

        //파일 옮기기
        $tmp = $file['tmp_name'];
        $path = './profile/' . time() . "_" . $file['name'];
        move_uploaded_file($tmp, $path);

        $point = 30;
        
        $sql3 = "INSERT INTO user(`name`, `id`,`pw`, `img`, `point`) VALUES (?, ?, ?, ?, ?)";
        $cnt3 = DB::query($sql3, [$name, $id, $pass, $path, $point]);
        if(!$cnt3){
            DB::msgAndBack("회원가입 실패");
            exit;
        }

        DB::msgAndGo("회원가입 성공", "/login");

    }

    public function profile() 
    {
        if(isset($_SESSION['user'])){
			$user = $_SESSION['user'];
        }else {
			$user = null;
		}

        if(!isset($_GET['id'])) {
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }

        $id = $_GET['id'];
        $sql = "select * from `user` where `id` = ?";
        $pu = DB::fetch($sql, [$id]);
        

        $this->render("profile", ["user" => $user, "pu" => $pu]);
    }

    public function profilechange() 
    {
        if(!isset($_SESSION['user'])){
			DB::msgAndBack("잘못된 접근입니다.");
        }

        $id = trim($_POST['id']);
        $name = trim($_POST['name']);
        $pass = trim($_POST['pw']);
        $cpass = trim($_POST['pwcheck']);
        $file = $_FILES['file'];

        // 비어있는지 체크
        if($id == "" || $name == "" || $pass == "" || $cpass == "" ) {
            DB::msgAndBack("필수입력란이 비어져있습니다. 모든 항목이 필수 입력란입니다.");
            exit;
        }

      

        //파일 옮기기
        if($file['size'] != 0) {
            
              //이미지 파일인지 체크
            if(explode("/", $file['type'])[0] != "image") {
                DB::msgAndBack("이미지 파일만 업로드 가능합니다.");
                exit;
            }
            $tmp = $file['tmp_name'];
            $path = './profile/' . time() . "_" . $file['name'];
            move_uploaded_file($tmp, $path);
            
            $sql3 = "update user set `name` = ?, `pw` = ?, `img` =? where id = ?";
            $cnt3 = DB::query($sql3, [$name,$pass, $path, $id]);
            if(!$cnt3){
                DB::msgAndBack("회원정보 수정 실패");
                exit;
            }
        }else {
            $sql3 = "update user set `name` = ?, `pw` = ? where id = ?";
            $cnt3 = DB::query($sql3, [$name,$pass, $id]);
            if(!$cnt3){
                DB::msgAndBack("회원정보 수정 실패");
                exit;
            }
        }
        
        $usersql = "select * from user where id = ?";
        $user = DB::fetch($usersql, [$id]);
        
        $_SESSION['user'] = $user;

        DB::msgAndGo("회원정보 수정 성공", "/profile&id=$id");

    }
}