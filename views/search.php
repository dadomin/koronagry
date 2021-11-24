<?php
    if($tag == "title") {
        $tag = "제목"; 
    }else if($tag == "sub") {
        $tag = "본문"; 
    }else if($tag == "name") {
        $tag = "글쓴이"; 
    }
?>
<section id="search">
    <h1 class="tc"><?= $tag ?>에 ' <?= $search ?> ' 를 포함한 검색 결과</h1>
    <div class="line"></div>
    <div class="board_list">
        <?php if($list == null) : ?>
            
        <h3 class="search-no">검색결과가 존재하지 않습니다.</h3>
        <?php else : ?>
            
        <table>
            <tr>
                <th width="60%">제목</th>
                <th width="10%">작성자</th>
                <th width="30%">작성일</th>
            </tr>
            <?php 
                    $list = array_reverse($list);
                    $cnt = count($list);
                    foreach($list as $item) : 
                ?>
            <tr>
                <td><a href="/view?idx=<?= $item->idx ?>"><?= $item->title?></a></td>
                <td class="tc"><a href="/profile&id=<?=$item->writer?>"><?= $item->name ?></a></td>
                <td class="tc"><?= $item->date?></td>
            </tr>
                <?php 
                    $cnt--;
                    endforeach; ?>

        </table>
        <?php endif; ?>
    </div>
</section>

