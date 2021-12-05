<div class="section_top">
    <h1><?= $category ?></h1>
</div>
<section id="board">
    <div class="board-left">
        <div class="view">
            <div class="view_title">
                <h1><?= $content->title?></h1>
                <div>
                    <h2><a href="/profile&id=<?=$content->writer?>"><?= $content->name ?></a><span><?= $content->date?></span></h2>
                    <p>조회 <span><?=$views?></span></p>
                </div>
            </div>
            <p><?= $content->sub ?></p>
            <?php foreach($imgs as $item) : ?>
                <div class="img-box">
                    <img src="<?= $item->file_name?>" alt="">
                    <div class="watermark"></div>
                </div>
            <?php endforeach; ?>
            <?php if($content->youtube != null) : ?>
                <div class="view_youtube">
                    <iframe width="854" height="480" src="https://www.youtube.com/embed/<?= $content->youtube ?>" frameborder="0" allowfullscreen></iframe>
                </div>
            <?php endif; ?>

            <?php if($islike) : ?>
            <form action="/unlike" method="post">
                <input type="hidden" name="idx" value="<?= $content->idx ?>">
                <input type="hidden" name="category" value="<?= $content->tag ?>">
                <button><b><?=$liked?></b><i class="fas fa-thumbs-up"></i><span>추천 취소하기</span></button>
            </form>
            <?php else : ?>
            <form action="/like" method="post">
                <input type="hidden" name="category" value="<?= $content->tag ?>">
                <input type="hidden" name="idx" value="<?= $content->idx ?>">
                <button><b><?=$liked?></b><i class="far fa-thumbs-up"></i><span>추천하기</span></button>
            </form>
            <?php endif; ?>
            
        </div>
        <?php if($user != null && $user->id == $content->writer) : ?>
            <div class="view_btns">
                <button class="btn"><a href="/modify/board&idx=<?= $content->idx ?>">수정</a></button>
                <button class="btn" onclick="deleteBoard()">삭제</button>
            </div>
            <form action="/delete/board" method="post">
                <input type="hidden" value="<?= $content->tag ?>" name="tag">
                <input type="hidden" value="<?= $content->idx ?>" name="idx">
                <input type="submit" class="dn" id="deleteBtn">
            </form>
        <?php endif;?>

        <div class="post-comments">
            <h1><i class="fas fa-comment"></i><span><?= $commentCnt ?></span> Comments</h1>
            <form action="/write/comment" class="post-comment-input" method="post">
                <input type="hidden" value="<?=$content->idx?>" name="idx">
                <textarea name="contents"></textarea>
                <button type="submit" class="btn">POST</button>
            </form>
            <div class="timeline">
                <?php foreach($comments as $item) : ?>
                <div class="comment">
                    <div class="comment-user-name">
                        <div class="user-img"><img src="<?= $item->img ?>" alt=""></div>
                        <a href="/profile&id=<?=$item->id?>"><?= $item->name ?></a>
                        <span><?= $item->date ?></span>
                    </div>
                    <p><?= $item->sub?></p>
                    <button><a href="comment/like?idx=<?=$item->idx?>"><i class="fas fa-heart"></i><span><?= $item->like_cnt ?></span></a></button>
                </div>
                <?php endforeach; ?>
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
