<div class="section_top">
    <h1>회원별 포인트 랭킹</h1>
</div>
<section id="rank">
    <h1 class="title"><span>순위별 목록</span></h1>
    <div class="rank-list">
        <?php foreach($list as $item) : ?>

            <div class="rank-box">
                <div>
                    <div class="user-img"><img src="<?=$item->img?>" alt=""></div>
                    <a href="/profile&id=<?=$item->id?>"><?=$item->name?></a>
                </div>
                <p><?=$item->point?></p>
            </div>
            
        <?php endforeach; ?>
    </div>
</section>

