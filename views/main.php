<!-- 
<nav id="home_menu">
    <ul>
        <li><a href="#"><i class="far fa-check-circle"></i><span>출석 체크</span></a></li>
        <li><a href="#"><i class="far fa-money-bill-alt"></i><span>포인트 구매</span></a></li>
        <li><a href="#"><i class="far fa-money-bill-alt"></i><span>1:1 문의</span></a></li>
    </ul>
</nav> -->


<section id="main">
    <div class="main-left">
        <div class="main-board">
            <h1 class="title"><span>최신글</span></h1>
            <div class="gallery">
                <?php foreach($recent as $key => $item) :?>
                    <?php if($key < 3) : ?>
                        <div>
                           <a href="/view?idx=<?=$item->idx?>">
                            <?php if($item->img == null && $item->youtube == null) :?>
                                <img src="./img/noimg.png" alt="">
                            <?php elseif($item->img == null) : ?>
                                <img src="http://img.youtube.com/vi/<?=$item->youtube?>/0.jpg" alt="">
                            <?php else : ?>
                                <img src="<?=$item->img?>" alt="">
                            <?php endif; ?>
                            <p><?= $item->title?></p>
                            <span><?= $item->name?></span>
                           </a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <ul>
                <?php foreach($recent as $key => $item) :?>
                    <?php if($key >= 3 &&  $key < 9) : ?>
                        <li><a href="/view?idx=<?= $item->idx ?>"><i class="fas fa-caret-right"></i><b><?= $item->title ?></b><span><?=$item->name?></span></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="main-board">
            <h1 class="title"><span>댓글많은글</span></h1>
            
            <div class="gallery">
            <?php foreach($reply as $key => $item) :?>
                <?php if($key < 3) : ?>
                    <div>
                        <a href="/view?idx=<?=$item->idx?>">
                        <?php if($item->img == null && $item->youtube == null) :?>
                            <img src="./img/noimg.png" alt="">
                        <?php elseif($item->img == null) : ?>
                            <img src="http://img.youtube.com/vi/<?=$item->youtube?>/0.jpg" alt="">
                        <?php else : ?>
                            <img src="<?=$item->img?>" alt="">
                        <?php endif; ?>
                        <p><?= $item->title?></p>
                        <span><?= $item->name?></span>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            </div>
            <ul>
                <?php foreach($reply as $key => $item) :?>
                    <?php if($key >= 3 &&  $key < 9) : ?>
                        <li><a href="/view?idx=<?= $item->idx ?>"><i class="fas fa-caret-right"></i><b><?= $item->title ?></b><span><?=$item->name?></span></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="main-gallery">
            <h1 class="title"><span>사진 게시판</span></h1>
            <div class='gallery'>
                <?php foreach($img as $key => $item) : ?>
                    <?php if($key < 6) : ?>
                        <div>
                            <a href="/view?idx=<?=$item->idx?>">
                                <img src="<?=$item->img?>" alt="">
                                <p><?=$item->title?></p>
                                <span><?=$item-> name?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                
            </div>
        </div>

        <div class="main-gallery">
            <h1 class="title"><span>동영상 게시판</span></h1>
            <div class="gallery">

                <?php foreach($video as $key => $item) : ?>
                    <?php if($key < 6) : ?>
                        <div>
                            <a href="/view?idx=<?=$item->idx?>">
                                <img src="http://img.youtube.com/vi/<?=$item->youtube?>/0.jpg" alt="">
                                <p><?=$item->title?></p>
                                <span><?=$item-> name?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

            </div>
        </div>
        
    </div>
    <div class="main-right">
       <div class="main-board">
            <h1 class="title"><span>Notice</span><a href="/notice">+ 더보기</a></h1>
            <ul>
            <?php foreach($notice as $key => $item) : ?>
                <?php if($key < 7) :?>
                    
                    <?php  $date=date_create($item->date); ?>
                    <li><a href="/notice/view?idx=<?=$item->idx?>"><p class="notice-tag">공지</p><b><?=$item->title?></b><span><?= date_format($date, "m.d")?></span></a></li>
                <?php endif; ?>
            <?php endforeach; ?>
            </ul>
       </div>
       <div class="main-board">
           <h1 class="title"><span>베스트 댓글</span></h1>
           <ul>
            <?php foreach($bestReply as $key => $item) : ?>
                <?php if($key < 7) :?>
                    <?php  $date=date_create($item->date); ?>
                    <li><a href="/view?idx=<?=$item->board_idx?>"><i class="fas fa-comment"></i><b><?=$item->sub?><span><?=$item->name?></b></span><span><?= date_format($date, "m.d")?></span></a></li>
                <?php endif; ?>
            <?php endforeach; ?>
            </ul>
       </div>
       <div class="main-board">
           <h1 class="title"><span>실시간 댓글</span></h1>
           <ul>
            <?php foreach($liveReply as $key => $item) : ?>
                <?php if($key < 7) :?>
                    <?php  $date=date_create($item->date); ?>
                    <li><a href="/view?idx=<?=$item->board_idx?>"><i class="fas fa-comment"></i><b><?=$item->sub?><span><?=$item->name?></b></span><span><?= date_format($date, "m.d")?></span></a></li>
                <?php endif; ?>
            <?php endforeach; ?>
            </ul>
       </div>
    </div>
</section>