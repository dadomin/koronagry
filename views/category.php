
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
                    <th width="50%">제목</th>
                    <th width="10%">작성자</th>
                    <th width="20%">작성일</th>
                    <th width="7%">조회수</th>
                    <th width="7%">추천수</th>
                </tr>
                <?php foreach($notice as $item) : ?>
                    <tr class="notice" onclick="location.href='/notice/view?idx=<?=$item->idx?>'" style="cursor:pointer;">
                        <td><span class="notice-tag">공지</span><?= $item->title?></td>
                        <td class="tc"><a href="/profile&id=admin">관리자</a></td>
                        <?php 
                            $date=date_create($item->date);?>
                        <td class="tc"><?= date_format($date, "Y.m.d")?></td>
                        <td class="tc">-</td>
                        <td class="tc">-</td>
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
                    <td class="tc"><?= $item->view_cnt?></td>
                    <td class="tc"><?=$item->like_cnt?></td>
                </tr>

                <?php 
                    endif;
                    $a++;
                    $cnt--;
                    
                    endforeach; ?>
            </table>

            <form action="/category/search" method="get" class="search_box_center" >
                <input type="text" name="idx" class="dn" value="<?=$tag?>">
                <div class="search_box">
                    <select name="search_tag" id="search_tag">
                        <option value="title">제목</option>
                        <option value="writer">작성자</option>
                        <option value="sub">내용</option>
                    </select>
                    <input type="text" name="contain">
                    <button><i class="fas fa-search"></i></button>
                </div>
            </form>

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
        <nav>
            <h1><span>Category</span></h1>
            <ul>
                <?php foreach($tags as $item) : ?>
                    <li <?php if($tag == $item->idx) :?> class="active" <?php endif; ?>><a href="/board/category?idx=<?=$item->idx?>"><?=$item->name?></a></li>    
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>

</section>
