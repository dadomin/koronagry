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
        
    </div>

    <div class="board-right">
        <button class="btn"><a href="/write">글쓰기</a></button>
        <nav>
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
