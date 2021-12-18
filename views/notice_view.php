<div class="section_top">
    <h1>공지사항</h1>
</div>
<section id="board">
    <div class="board-left">
        <div class="view">
            <div class="view_title">
                <h1><?= $content->title?></h1>
                <div>
                    <h2>관리자<span><?= $content->date?></span></h2>
                </div>
            </div>
            <p><?= $content->sub ?></p>

            
        </div>

        <?php if($user != null && $user->id == "admin") : ?>
            <div class="view_btns">
                <button class="btn"><a href="/modify/notice&idx=<?= $content->idx ?>">수정</a></button>
                <button class="btn" onclick="deleteBoard()">삭제</button>
            </div>
            <form action="/delete/notice" method="post">
                <input type="hidden" value="<?= $content->idx ?>" name="idx">
                <input type="submit" class="dn" id="deleteBtn">
            </form>
        <?php endif;?>
        
    </div>

    <div class="board-right">
        <!-- <button class="btn"><a href="/write">글쓰기</a></button> -->
        <nav>
            
            <h1><span>Category</span></h1>
            <ul>
                <?php foreach($tags as $item) : ?>
                    <li><a href="/board/category?idx=<?=$item->idx?>"><?=$item->name?></a></li>    
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>

</section>
