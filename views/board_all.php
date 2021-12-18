
<div class="section_top">
    <h1>전체 게시판</h1>
</div>
<section id="board">
    <div class="board-left">
        <div class="best_tab">

            <?php for($i =0; $i < count($days); $i++) : ?>
                <div class="best-box">
                    <div class="best-box-title">
                        <h1 class="title"><span><a href="/board/category?idx=<?=$list[$i]->idx?>"><?=$list[$i]->name?></a></span><a href="/write?category=1" class="bold">+ 글쓰기</a></h1>
                    
                    </div>
                    <ul>
                        <?php foreach($days[$i] as $key => $item ) : ?>
                            <?php if($key <= 4) : ?>
                            <?php 
                                $date=date_create($item->date);?>
                            <li><a href="/view?idx=<?=$item->idx?>"><p><?=$key+1?></p><b><?= $item->title ?></b><span class="date"><?= date_format($date, "m.d")?></span></a></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <div class="board-right">
        <!-- <button class="btn"><a href="/write">글쓰기</a></button> -->
        <nav>
            
        <h1><span>Category</span></h1>
            <ul>
                <?php foreach($list as $item) : ?>
                    <li><a href="/board/category?idx=<?=$item->idx?>"><?=$item->name?></a></li>    
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>

</section>
