
<?php

$start = null;
if(isset($_GET['start'])){
    $start = $_GET['start'];
}else {
    $start=0;
}

$scale = 10;
$page_scale = 5;

$total_page = ceil($total / $scale);
$page = floor($total_page / $page_scale);
$n_page = floor($start / $page_scale);

?>


<section id="notice">
        <h1>공지글</h1>
        <div class="board_list">
            <table>
                
                <tr>
                    <th width="54%">제목</th>
                    <th width="10%">작성자</th>
                    <th width="30%">작성일</th>
                </tr>
                <?php 
                    $list = array_reverse($list);
                    $cnt = count($list);
                    $a = 1;
                    foreach($list as $item) : 
                    
                    $n = $scale*($start+1) - $total;
                    if($a > $scale*$start && $a < $scale*$start+11) :
                ?>
                <tr>
                    <td><a href="/notice/view?idx=<?= $item->idx ?>"><span class="notice-tag">공지</span><?= $item->title?></a></td>
                    <td class="tc"><a href="/profile&id=admin">관리자</a></td>
                    <?php 
                        $date=date_create($item->date);?>
                    <td class="tc"><?= date_format($date, "Y.m.d")?></td>
                </tr>

                <?php 
                    endif;
                    $a++;
                    $cnt--;
                    endforeach; ?>
            </table>

            <div class="list-page-btns">
            
                <?php


                if($n_page > 0) {
                    $p_start = ($n_page -1) * $page_scale;
                    $link = "<button class='btn'><a href='/notice?start=${p_start}'>";
                    $link .= "Prev";
                    $link .= "</a></button>";
                    echo $link." ";
                }
                $is = $n_page*$page_scale;
                for($i=$is; $i < $is+$page_scale; $i++){
                    
                        if($i < $total_page){
                        $link = "<button class='btn'><a href='/notice?start=${i}'>";
                        $link .= $i+1;
                        $link .= "</a></button>";
                        echo $link." ";
                    }
                }

                if($n_page < $page){
                    $link = "<button class='btn'><a href='/notice?start=${i}'>";
                    $link .= "Next";
                    $link .= "</a></button>";
                    echo $link." ";
                }

                ?>
            </div>
        </div>


</section>