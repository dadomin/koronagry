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
                <img src="<?= $item->file_name?>" alt="">
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
                <button><b><?=$liked?></b><i class="fas fa-heart"></i><span>추천 취소하기</span></button>
            </form>
            <?php else : ?>
            <form action="/like" method="post">
                <input type="hidden" name="category" value="<?= $content->tag ?>">
                <input type="hidden" name="idx" value="<?= $content->idx ?>">
                <button><b><?=$liked?></b><i class="far fa-heart"></i><span>추천하기</span></button>
            </form>
            <?php endif; ?>
            
        </div>
        <?php if($user != null && $user->id == $content->writer) : ?>
            <div class="view_btns">
                <button class="btn"><a href="/modify/board&idx=<?= $content->idx ?>">수정</a></button>
                <button class="btn" onclick="deleteBoard()">삭제</button>
            </div>
        <?php endif;?>
        <form action="/delete/board" method="post">
            <input type="hidden" value="<?= $content->tag ?>" name="tag">
            <input type="hidden" value="<?= $content->idx ?>" name="idx">
            <input type="submit" class="dn" id="deleteBtn">
        </form>
    </div>

    <div class="board-right">
        <button class="btn"><a href="/write">글쓰기</a></button>
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
