
<?php
$today = date("Y . m . d");
?>

<!-- <nav id="home_menu">
    <ul>
        <li><a href="#"><i class="far fa-check-circle"></i><span>출석 체크</span></a></li>
        <li><a href="#"><i class="far fa-money-bill-alt"></i><span>포인트 구매</span></a></li>
        <li><a href="#"><i class="far fa-money-bill-alt"></i><span>1:1 문의</span></a></li>
    </ul>
</nav> -->

<section id="main_best">

    <div class="best_tab">
        <h2>일간 BEST</h2>

        <div class="best_tab_tag">
            <div class="best_tag_title">
                <h2>카테고리1</h2>
                <a href="/board/category?idx=1">+ 더보기</a>
            </div>
            <ul>
                <?php foreach($days[0] as $key => $item ) : ?>
                    <?php if($key <= 5) : ?>
                    <li><a href="/view?idx=<?=$item->idx?>"><span><?=$key+1?></span><p><?= $item->title ?></p></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="best_tab_tag">
            <div class="best_tag_title">
                <h2>카테고리2</h2>
                <a href="/board/category?idx=2">+ 더보기</a>
            </div>
            <ul>
                <?php foreach($days[1] as $key => $item ) : ?>
                    <?php if($key <= 5) : ?>
                    <li><a href="/view?idx=<?=$item->idx?>"><span><?=$key+1?></span><p><?= $item->title ?></p></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="best_tab_tag">
            <div class="best_tag_title">
                <h2>카테고리3</h2>
                <a href="/board/category?idx=3">+ 더보기</a>
            </div>
            <ul>
                <?php foreach($days[2] as $key => $item ) : ?>
                    <?php if($key <= 5) : ?>
                    <li><a href="/view?idx=<?=$item->idx?>"><span><?=$key+1?></span><p><?= $item->title ?></p></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="best_tab_tag">
            <div class="best_tag_title">
                <h2>카테고리4</h2>
                <a href="/board/category?idx=4">+ 더보기</a>
            </div>
            <ul>
                <?php foreach($days[3] as $key => $item ) : ?>
                    <?php if($key <= 5) : ?>
                    <li><a href="/view?idx=<?=$item->idx?>"><span><?=$key+1?></span><p><?= $item->title ?></p></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="best_tab_tag">
            <div class="best_tag_title">
                <h2>카테고리5</h2>
                <a href="/board/category?idx=5">+ 더보기</a>
            </div>
            <ul>
                <?php foreach($days[4] as $key => $item ) : ?>
                    <?php if($key <= 5) : ?>
                    <li><a href="/view?idx=<?=$item->idx?>"><span><?=$key+1?></span><p><?= $item->title ?></p></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    
    <div class="best_tab">
        <h2>주간 BEST</h2>

        <div class="best_tab_tag">
            <div class="best_tag_title">
                <h2>카테고리1</h2>
                <a href="/board/category?idx=1">+ 더보기</a>
            </div>
            <ul>
                <?php foreach($weekends[0] as $key => $item ) : ?>
                    <?php if($key <= 5) : ?>
                    <li><a href="/view?idx=<?=$item->idx?>"><span><?=$key+1?></span><p><?= $item->title ?></p></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="best_tab_tag">
            <div class="best_tag_title">
                <h2>카테고리2</h2>
                <a href="/board/category?idx=2">+ 더보기</a>
            </div>
            <ul>
                <?php foreach($weekends[1] as $key => $item ) : ?>
                    <?php if($key <= 5) : ?>
                    <li><a href="/view?idx=<?=$item->idx?>"><span><?=$key+1?></span><p><?= $item->title ?></p></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="best_tab_tag">
            <div class="best_tag_title">
                <h2>카테고리3</h2>
                <a href="/board/category?idx=3">+ 더보기</a>
            </div>
            <ul>
                <?php foreach($weekends[2] as $key => $item ) : ?>
                    <?php if($key <= 5) : ?>
                    <li><a href="/view?idx=<?=$item->idx?>"><span><?=$key+1?></span><p><?= $item->title ?></p></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="best_tab_tag">
            <div class="best_tag_title">
                <h2>카테고리4</h2>
                <a href="/board/category?idx=4">+ 더보기</a>
            </div>
            <ul>
                <?php foreach($weekends[3] as $key => $item ) : ?>
                    <?php if($key <= 5) : ?>
                    <li><a href="/view?idx=<?=$item->idx?>"><span><?=$key+1?></span><p><?= $item->title ?></p></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="best_tab_tag">
            <div class="best_tag_title">
                <h2>카테고리5</h2>
                <a href="/board/category?idx=5">+ 더보기</a>
            </div>
            <ul>
                <?php foreach($weekends[4] as $key => $item ) : ?>
                    <?php if($key <= 5) : ?>
                    <li><a href="/view?idx=<?=$item->idx?>"><span><?=$key+1?></span><p><?= $item->title ?></p></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    
    <div class="best_tab">
        <h2>월간 BEST</h2>

        <div class="best_tab_tag">
            <div class="best_tag_title">
                <h2>카테고리1</h2>
                <a href="/board/category?idx=1">+ 더보기</a>
            </div>
            <ul>
                <?php foreach($months[0] as $key => $item ) : ?>
                    <?php if($key <= 5) : ?>
                    <li><a href="/view?idx=<?=$item->idx?>"><span><?=$key+1?></span><p><?= $item->title ?></p></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="best_tab_tag">
            <div class="best_tag_title">
                <h2>카테고리2</h2>
                <a href="/board/category?idx=2">+ 더보기</a>
            </div>
            <ul>
                <?php foreach($months[1] as $key => $item ) : ?>
                    <?php if($key <= 5) : ?>
                    <li><a href="/view?idx=<?=$item->idx?>"><span><?=$key+1?></span><p><?= $item->title ?></p></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="best_tab_tag">
            <div class="best_tag_title">
                <h2>카테고리3</h2>
                <a href="/board/category?idx=3">+ 더보기</a>
            </div>
            <ul>
                <?php foreach($months[2] as $key => $item ) : ?>
                    <?php if($key <= 5) : ?>
                    <li><a href="/view?idx=<?=$item->idx?>"><span><?=$key+1?></span><p><?= $item->title ?></p></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="best_tab_tag">
            <div class="best_tag_title">
                <h2>카테고리4</h2>
                <a href="/board/category?idx=4">+ 더보기</a>
            </div>
            <ul>
                <?php foreach($months[3] as $key => $item ) : ?>
                    <?php if($key <= 5) : ?>
                    <li><a href="/view?idx=<?=$item->idx?>"><span><?=$key+1?></span><p><?= $item->title ?></p></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="best_tab_tag">
            <div class="best_tag_title">
                <h2>카테고리5</h2>
                <a href="/board/category?idx=5">+ 더보기</a>
            </div>
            <ul>
                <?php foreach($months[4] as $key => $item ) : ?>
                    <?php if($key <= 5) : ?>
                    <li><a href="/view?idx=<?=$item->idx?>"><span><?=$key+1?></span><p><?= $item->title ?></p></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

</section>