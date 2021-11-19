<section id="board">
    <div class="board-left">
        <h1>전체 게시판</h1>
        <div class="best_tab">

            <div class="best_tab_tag">
                <div class="best_tag_title">
                    <h2>카테고리1</h2>
                    <a href="/board/category?idx=1">+ 더보기</a>
                </div>
                <ul>
                    <?php foreach($day1 as $key => $item ) : ?>
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
                    <?php foreach($day2 as $key => $item ) : ?>
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
                    <?php foreach($day3 as $key => $item ) : ?>
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
                    <?php foreach($day4 as $key => $item ) : ?>
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
                    <?php foreach($day5 as $key => $item ) : ?>
                        <?php if($key <= 5) : ?>
                        <li><a href="/view?idx=<?=$item->idx?>"><span><?=$key+1?></span><p><?= $item->title ?></p></a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="board-right">
        <button class="btn"><a href="/write">글쓰기</a></button>
        <nav>
            <ul>
                <li><a href="/board/category?idx=1">카테고리1</a></li>
                <li><a href="/board/category?idx=2">카테고리2</a></li>
                <li><a href="/board/category?idx=3">카테고리3</a></li>
                <li><a href="/board/category?idx=4">카테고리4</a></li>
                <li><a href="/board/category?idx=5">카테고리5</a></li>
            </ul>
        </nav>
    </div>

</section>
