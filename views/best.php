<div class="section_top">
    <h1>카테고리별 <?= $when ?> 베스트 글</h1>
</div>
<section id="best">
    <div class="best-box">
        <div class="best_box">
            <h1 class="title"><span>카테고리1</span>
            <a href="/board/category?idx=1">+ 더보기</a></h1>
        </div>
        <ul>
            <?php foreach($list[0] as $key => $item ) : ?>
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
            <h1 class="title"><span>카테고리2</span>
            <a href="/board/category?idx=2">+ 더보기</a></h1>
        </div>
        <ul>
            <?php foreach($list[1] as $key => $item ) : ?>
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
            <h1 class="title"><span>카테고리3</span>
            <a href="/board/category?idx=3">+ 더보기</a></h1>
        </div>
        <ul>
            <?php foreach($list[2] as $key => $item ) : ?>
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
            <h1 class="title"><span>카테고리4</span>
            <a href="/board/category?idx=4">+ 더보기</a></h1>
        </div>
        <ul>
            <?php foreach($list[3] as $key => $item ) : ?>
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
            <h1 class="title"><span>카테고리5</span>
            <a href="/board/category?idx=5">+ 더보기</a></h1>
        </div>
        <ul>
            <?php foreach($list[4] as $key => $item ) : ?>
                <?php if($key <= 4) : ?>
                    <?php 
                        $date=date_create($item->date);?>
                <li><a href="/view?idx=<?=$item->idx?>"><p><?=$key+1?></p><b><?= $item->title ?></b><span class="date"><?= date_format($date, "m.d")?></span></a></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</section>