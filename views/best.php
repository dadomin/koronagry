<div class="section_top">
    <h1>카테고리별 <?= $when ?> 베스트 글</h1>
</div>
<section id="best">

    
    <?php for($i =0; $i < count($list); $i++) : ?>
        <div class="best-box">
            <div class="best-box-title">
                <h1 class="title"><span><a href="/board/category?idx=<?=$tags[$i]->idx?>"><?=$tags[$i]->name?></a></span></h1>
            
            </div>
            <ul>
                <?php foreach($list[$i] as $key => $item ) : ?>
                    <?php if($key <= 4) : ?>
                    <?php 
                        $date=date_create($item->date);?>
                    <li><a href="/view?idx=<?=$item->idx?>"><p><?=$key+1?></p><b><?= $item->title ?></b><span class="date"><?= date_format($date, "m.d")?></span></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endfor; ?>

</section>