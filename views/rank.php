<section id="rank">
    <h1>포인트 랭킹</h1>
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

