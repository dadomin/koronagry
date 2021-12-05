
<div class="section_top">
    <h1>전체 게시판</h1>
</div>
<section id="board">
    <div class="board-left">
        <div class="best_tab">

            <div class="best-box">
                <div class="best-box-title">
                    <h1 class="title"><span>카테고리1</span>  <a href="/board/category?idx=1">+ 더보기</a></h1>
                   
                </div>
                <ul>
                    <?php foreach($day1 as $key => $item ) : ?>
                        <?php if($key <= 4) : ?>
                        <?php 
                            $date=date_create($item->date);?>
                        <li><a href="/view?idx=<?=$item->idx?>"><p><?=$key+1?></p><b><?= $item->title ?></b><span class="date"><?= date_format($date, "m.d")?></span></a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="best-box">
                <div class="best-box-title">
                    <h1 class="title"><span>카테고리2</span>  <a href="/board/category?idx=2">+ 더보기</a></h1>
                   
                </div>
                <ul>
                    <?php foreach($day2 as $key => $item ) : ?>
                        <?php if($key <= 4) : ?>
                        <?php 
                            $date=date_create($item->date);?>
                        <li><a href="/view?idx=<?=$item->idx?>"><p><?=$key+1?></p><b><?= $item->title ?></b><span class="date"><?= date_format($date, "m.d")?></span></a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="best-box">
                <div class="best-box-title">
                    <h1 class="title"><span>카테고리3</span>  <a href="/board/category?idx=3">+ 더보기</a></h1>
                   
                </div>
                <ul>
                    <?php foreach($day3 as $key => $item ) : ?>
                        <?php if($key <= 4) : ?>
                        <?php 
                            $date=date_create($item->date);?>
                        <li><a href="/view?idx=<?=$item->idx?>"><p><?=$key+1?></p><b><?= $item->title ?></b><span class="date"><?= date_format($date, "m.d")?></span></a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="best-box">
                <div class="best-box-title">
                    <h1 class="title"><span>카테고리4</span>  <a href="/board/category?idx=4">+ 더보기</a></h1>
                   
                </div>
                <ul>
                    <?php foreach($day4 as $key => $item ) : ?>
                        <?php if($key <= 4) : ?>
                        <?php 
                            $date=date_create($item->date);?>
                        <li><a href="/view?idx=<?=$item->idx?>"><p><?=$key+1?></p><b><?= $item->title ?></b><span class="date"><?= date_format($date, "m.d")?></span></a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="best-box">
                <div class="best-box-title">
                    <h1 class="title"><span>카테고리5</span>  <a href="/board/category?idx=5">+ 더보기</a></h1>
                   
                </div>
                <ul>
                    <?php foreach($day5 as $key => $item ) : ?>
                        <?php if($key <= 4) : ?>
                        <?php 
                            $date=date_create($item->date);?>
                        <li><a href="/view?idx=<?=$item->idx?>"><p><?=$key+1?></p><b><?= $item->title ?></b><span class="date"><?= date_format($date, "m.d")?></span></a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="board-right">
        <!-- <button class="btn"><a href="/write">글쓰기</a></button> -->
        <nav>
            
        <h1><span>Category</span></h1>
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
