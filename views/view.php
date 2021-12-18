<div class="section_top">
    <h1><?= $category ?></h1>
</div>
<section id="board">
    <div class="board-left">
        <div class="view">
            <div class="view_title">
                <h1><?= $content->title?></h1>
                <div>
                    <h2><a href="/profile&id=<?=$content->writer?>"><?= $content->name ?></a><span><?= $content->date?></span><a href="/report/board?idx=<?=$content->idx?>" class="report"><i class="far fa-lightbulb"></i>신고</a></h2>
                    <p>조회 <span><?=$views?></span></p>
                </div>
            </div>

            <?php if($content->blind == 0) : ?>
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
                <input type="hidden" name="writer" value="<?=$content->writer?>">
                <input type="hidden" name="category" value="<?= $content->tag ?>">
                <button><b><?=$liked?></b><i class="fas fa-thumbs-up"></i><span>추천 취소하기</span></button>
            </form>
            <?php else : ?>
            <form action="/like" method="post">
                <input type="hidden" name="category" value="<?= $content->tag ?>">
                <input type="hidden" name="writer" value="<?=$content->writer?>">
                <input type="hidden" name="idx" value="<?= $content->idx ?>">
                <button><b><?=$liked?></b><i class="far fa-thumbs-up"></i><span>추천하기</span></button>
            </form>
            <?php endif; ?>
            <?php else : ?>
                <p>이 글은 관리자에 의해 블라인드 처리되었습니다.</p>
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
        <?php if($user != null && $user->id == "admin") : ?>
            <div class="view_btns">
                <?php if($content->blind == 0) : ?>
                    <button class="btn"><a href="/admin/blind&idx=<?= $content->idx ?>">블라인드</a></button>
                <?php else : ?>
                    <button class="btn"><a href="/admin/show&idx=<?= $content->idx ?>">블라인드 취소</a></button>
                <?php endif; ?>
                <button class="btn" onclick="deleteBoard()">삭제</button>
            </div>
            <form action="/delete/board" method="post">
                <input type="hidden" value="<?= $content->tag ?>" name="tag">
                <input type="hidden" value="<?= $content->idx ?>" name="idx">
                <input type="submit" class="dn" id="deleteBtn">
            </form>
        <?php endif; ?>

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
                        <p>L.<?=$item->point?></p>
                        <a href="/profile&id=<?=$item->id?>"><?= $item->name ?></a>
                        <?php if($content->writer == $item->id) : ?>
                            <b>작성자</b>
                        <?php endif;?>
                        <a href="/report/comment?idx=<?=$item->idx?>" class="report"><i class="far fa-lightbulb"></i>신고</a>
                        <span><?= $item->date ?></span>
                        
                    </div>
                    <p><?php if($item->mention != "") : ?><span>@<?=$item->mention?></span><?php endif; ?><?= $item->sub?></p>
                    <button><a href="comment/like?idx=<?=$item->idx?>"><i class="fas fa-heart"></i><span><?= $item->like_cnt ?></span></a></button>
                
                    <button class="mention">답글달기</button>
                    <input type="checkbox" class="dn">
                    <form action="/write/comment" class="post-comment-input" method="post">
                        <input type="hidden" name="mention" value="<?=$item->writer?>">
                        <input type="hidden" name="mention_id" value="<?=$item->name?>">
                        <input type="hidden" value="<?=$content->idx?>" name="idx">
                        <textarea name="contents"></textarea>
                        <button type="submit" class="btn">POST</button>
                    </form>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
    </div>
    <script>
        $(".mention").on("click", (e)=>{
            $(e.target.parentNode).children("input").attr("checked", "checked");
        });
    </script>
        

    <div class="board-right">
        <!-- <button class="btn"><a href="/write">글쓰기</a></button> -->
        <nav>
            
        <h1><span>Category</span></h1>
            <ul>
                <?php foreach($tags as $item) : ?>
                    <li <?php if($content->tag == $item->idx) :?> class="active" <?php endif; ?>><a href="/board/category?idx=<?=$item->idx?>"><?=$item->name?></a></li>    
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>

</section>
