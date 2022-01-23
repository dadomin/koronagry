<div class="section_top">
    <h1>회원별 포인트 랭킹</h1>
</div>
<section id="rank">
    <h1 class="title"><span>순위별 목록</span></h1>
    <div class="rank-list">
        <?php foreach($list as $item) : ?>

            <?php if($item->id != "admin") : ?>
            <div class="rank-box">
                
                <div>
                    <?php if($item->point >= end($level)->point) : ?>
                        <img src='./img/level/<?=end($level)->level?>.gif' alt=''style='margin-right: 5px;'>
                    <?php else: ?>
                    <?php foreach($level as $l) : ?>
                        <?php if($item->point <= $l->point) : ?>
                            <img src='./img/level/<?=$l->level - 1?>.gif' alt=''style='margin-right: 5px;'>
                        <?php break; endif; ?>
                    <?php endforeach; ?>
                    <?php endif;?>
                    <div class="user-img"><img src="<?=$item->img?>" alt=""></div>
                    <a href="/profile&id=<?=$item->id?>"><?=$item->name?></a>
                </div>
                
                <p><?=$item->point?></p>
            </div>
            <?php endif; ?>
            
        <?php endforeach; ?>
    </div>
</section>
