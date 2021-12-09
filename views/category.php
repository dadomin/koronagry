
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
<div class="section_top">
    <h1><?=$category?></h1>
</div>
<section id="board">
    <div class="board-left">
        <div class="best_tab">

            <div class="best-box">
                <div class="best-box-title">
                    <h1 class="title"><span>오늘의 인기글</span></h1>
                </div>
                <ul>
                    <?php foreach($best as $key => $item ) : ?>
                        
                        <?php if($key <= 4) : ?>                
                        <li><a href="/view?idx=<?=$item->idx?>"><p><?=$key+1?></p><b><?= $item->title ?></b><span></span></a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="board_list">
            <h1 class="title"><span>게시판</span><a href="/write?category=<?=$tag?>" class="bold">+ 글쓰기</a></h1>
            <table>
                
                <tr>
                    <th width="54%">제목</th>
                    <th width="10%">작성자</th>
                    <th width="30%">작성일</th>
                </tr>
                <?php foreach($notice as $item) : ?>
                    <tr class="notice" onclick="location.href='/notice/view?idx=<?=$item->idx?>'" style="cursor:pointer;">
                        <td><span class="notice-tag">공지</span><?= $item->title?></td>
                        <td class="tc"><a href="/profile&id=admin">관리자</a></td>
                        <?php 
                            $date=date_create($item->date);?>
                        <td class="tc"><?= date_format($date, "Y.m.d")?></td>
                    </tr>
                <?php endforeach; ?>
                <?php 
                    $list = array_reverse($list);
                    $cnt = count($list);
                    $a = 1;
                    foreach($list as $item) : 
                    
                    $n = $scale*($start+1) - $total;
                    if($a > $scale*$start && $a < $scale*$start+11) :
                ?>
                <tr>
                    <td><a href="/view?idx=<?= $item->idx ?>"><?= $item->title?></a></td>
                    <td class="tc"><a href="/profile&id=<?=$item->writer?>"><?= $item->name ?></a></td>
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
                    $link = "<button class='btn'><a href='/board/category?idx=".$tag."&start=${p_start}'>";
                    $link .= "Prev";
                    $link .= "</a></button>";
                    echo $link." ";
                }
                $is = $n_page*$page_scale;
                for($i=$is; $i < $is+$page_scale; $i++){
                    
                        if($i < $total_page){
                        $link = "<button class='btn'><a href='/board/category?idx=".$tag."&start=${i}'>";
                        $link .= $i+1;
                        $link .= "</a></button>";
                        echo $link." ";
                    }
                }

                if($n_page < $page){
                    $link = "<button class='btn'><a href='/board/category?idx=".$tag."&start=${i}'>";
                    $link .= "Next";
                    $link .= "</a></button>";
                    echo $link." ";
                }

                ?>
            </div>
        </div>
    </div>

    <div class="board-right">
        <!-- <button class="btn"><a href="/write?category=<?=$tag?>">글쓰기</a></button> -->
        <nav>
            <h1><span>Category</span></h1>
            <ul>
                <li <?php if($tag == 1) :?> class="active" <?php endif; ?>><a href="/board/category?idx=1">카테고리1</a></li>
                <li <?php if($tag == 2) :?> class="active" <?php endif; ?>><a href="/board/category?idx=2">카테고리2</a></li>
                <li <?php if($tag == 3) :?> class="active" <?php endif; ?>><a href="/board/category?idx=3">카테고리3</a></li>
                <li <?php if($tag == 4) :?> class="active" <?php endif; ?>><a href="/board/category?idx=4">카테고리4</a></li>
                <li <?php if($tag == 5) :?> class="active" <?php endif; ?>><a href="/board/category?idx=5">카테고리5</a></li>
            </ul>
        </nav>
    </div>

</section>
