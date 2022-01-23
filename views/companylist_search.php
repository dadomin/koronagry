
<?php

$start = null;
if(isset($_GET['start'])){
    $start = $_GET['start'];
}else {
    $start=0;
}

$scale = 5;
$page_scale = 5;

$total_page = ceil($total / $scale);
$page = floor($total_page / $page_scale);
$n_page = floor($start / $page_scale);
if($tag == "name") {
    $tag_name = "이름";
}else if($tag == "address") {
    $tag_name = "주소";
}else if($tag == "info") {
    $tag_name = "정보";
}
?>

<div class="section_top">
<h1>업체 소개</h1>
</div>
<section id="company-list">

<h1 class="title"><span>업체 목록</span><?php if($user->id == 'admin') : ?><a href="/company/add" class="bold">+ 추가하기</a><?php endif; ?></h1>
<p><?=$tag_name?>에 ' <?=$contain?> ' 이 포함된 업체 목록</p>
<div class="companies">

    <?php if($total == 0) : ?>
    <h2>검색된 내용이 없습니다.</h2>
    
    <?php endif;?>

    <?php 
        $list = array_reverse($list);
        $cnt = count($list);
        $a = 1;
        foreach($list as $item) : 
        
        $n = $scale*($start+1) - $total;
        if($a > $scale*$start && $a < $scale*$start+6) :
    ?>
   <div class="company">
        <div class="company-img">
            <?php if($item->img == null) : ?>
                <img src="./img/noimg.png" alt="">
            <?php else : ?>
                <img src="<?=$item->img?>" alt="">
            <?php endif; ?>
        </div>
        <div class="company-info">
            <ul>
                <li><span>이름</span><p><?= $item->name ?></p></li>
                <li><span>주소</span><p><?= $item->address ?> <?= $item->sub_address?></p></li>
                <li><span>정보</span><p><?= $item->info?></p></li>
            </ul>
        </div>
        <div class="company-star">
            <?php  if($item->star == null) :  ?>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
            <?php else : ?>
                <?php
                    $i = 1;
                    while($i<=5){
                        if($i <= $item->star){
                            echo "<i class='fas fa-star'></i>";
                        }else {
                            echo "<i class='far fa-star'></i>";
                        }
                        $i++;
                    }
                ?>
            <?php endif; ?>
        </div>
        <button>
            <a href="/company&idx=<?= $item->idx ?>">Go <i class="fas fa-chevron-right"></i></a>
        </button>
    </div>

    <?php 
        endif;
        $a++;
        $cnt--;
        endforeach; ?>
    <form action="/introduce/search" method="get" class="search_box_center">
        <div class="search_box">
            <select name="tag" id="tag">
                <option value="name">이름</option>
                <option value="address">주소</option>
                <option value="info">정보</option>
            </select>
            <input type="text" name="contain">
            <button><i class="fas fa-search"></i></button>
        </div>
    </form>
    <div class="list-page-btns">
        
        <?php

            $tag = $_GET['tag'];
            $contain = $_GET['contain'];
            if($n_page > 0) {
                $p_start = ($n_page -1) * $page_scale;
                $link = "<button class='btn'><a href='/introduce/search&start=${p_start}&tag=${tag}&contain=${contain}'>";
                $link .= "Prev";
                $link .= "</a></button>";
                echo $link." ";
            }
            $is = $n_page*$page_scale;
            for($i=$is; $i < $is+$page_scale; $i++){
                
                    if($i < $total_page){
                    $link = "<button class='btn'><a href='/introduce/search&start=${i}&tag=${tag}&contain=${contain}'>";
                    $link .= $i+1;
                    $link .= "</a></button>";
                    echo $link." ";
                }
            }

            if($n_page < $page){
                $link = "<button class='btn'><a href='/introduce/search&start=${i}&tag=${tag}&contain=${contain}'>";
                $link .= "Next";
                $link .= "</a></button>";
                echo $link." ";
            }
        

        ?>
    </div>
</div>

</section>