<?php

namespace Korona\Controller;

use Korona\DB;

class CompanyController extends MasterController {

    public function all()
    {
        if(isset($_SESSION['user'])){
			$user = $_SESSION['user'];
        }else {
			$user = null;
		}

        $sql = "SELECT *, ROUND(`star_all`/`star_cnt`) as star FROM `company`";
        $list = DB::fetchAll($sql, []);
        $this->render("companylist", ["user" => $user, "list" => $list]);
    }

    public function add()
    {
        if(!isset($_SESSION['user'])){
            DB::msgAndBack("잘못된 접근입니다.");
            exit;
        }
        $user = $_SESSION['user'];

        $this->render("companyadd", ["user" => $user]);
    }

    public function addOk()
    {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $sub_address = $_POST['sub-address'];
        $info = $_POST['info'];

        if($name == "" || $address == "" || $info == "") {
            DB::msgAndBack("업체의 이름, 주소, 정보는 비워져있을 수 없습니다.");
            exit;
        }

        $file = $_FILES['file'];
    
        
        if($file['size'] != 0) {
            if(explode("/", $file['type'])[0] != "image") {
                DB::msgAndBack("이미지 파일만 업로드 가능합니다.");
                exit;
            }
            $tmp = $file['tmp_name'];
            if($tmp != null) {
                $path = './company/' .time()."_".$file['name'];
                move_uploaded_file($tmp, $path);
            }
        }else {
            $path = null;
        }

        $sql = "INSERT INTO `company`(`name`, `address`, `sub_address`, `info`, `img`) VALUES (?,?,?,?,?)";
        $cnt = DB::query($sql, [$name, $address, $sub_address, $info, $path]);

        if($cnt) {
            DB::msgAndGo("업체 추가가 완료되었습니다.", "/introduce");
        }else {
            DB::msgAndBack("업체 추가 작업 중 오류 발생");
        }
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
        $sql = "SELECT *,ROUND(`star_all`/`star_cnt`, 1) as star FROM `company` WHERE `idx` = ?";
        $company = DB::fetch($sql, [$idx]);

        if($company == null) {
            DB::msgAndBack("해당 업체가 존재하지 않습니다.");
            exit;
        }

        $reviewSql = "SELECT * FROM `review` a, `user` b WHERE a.company_idx = ? and a.writer = b.id";
        $review = DB::fetchAll($reviewSql, [$idx]);

        $cntSql = "SELECT count(*) as cnt FROM `review` WHERE company_idx = ?";
        $cnt = DB::fetch($cntSql, [$idx])->cnt;

        $this->render("company", ["user" => $user, "company" => $company, "review" => $review, "cnt" =>$cnt]);
    }

    public function reviewAdd()
    {
        if(!isset($_SESSION['user'])){
            DB::msgAndBack("로그인 후 이용해주세요.");
            exit;
        }
        
        $user = $_SESSION['user'];
        
        $company_idx = $_POST['company_idx'];
        $writer = $user->id;
        $comment = $_POST['comment'];
        $star = $_POST['star'];

        if($comment == "") {
            DB::msgAndBack("평가내용을 입력하세요.");
            exit;
        }
        
        $day = new \DateTime('now', new \DateTimeZone('Asia/Seoul'));
        $date = $day->format('Y.m.d');

        $insertSql = "INSERT INTO `review`(`company_idx`,`writer`,`comment`,`star`, `date`) VALUES (?,?,?,?,?)";
        $insertCnt = DB::query($insertSql, [$company_idx,$writer,$comment,$star,$date]);

        $updateSql = "UPDATE `company` SET `star_cnt` = `star_cnt`+1, `star_all` = `star_all` + ? WHERE `idx` = ?";
        $updateCnt = DB::query($updateSql, [$star, $company_idx]);

        if(!$insertCnt || !$updateCnt) {
            DB::msgAndBack("DB 오류");
            exit;
        }
        DB::msgAndGo("리뷰 작성 완료", "/company&idx=$company_idx");
    }


}