<section id="board">
    <div class="board-left">
        <h1><?= $category ?></h1>
        <div class="best_tab">

            <div class="best_tab_tag">
                <div class="best_tag_title">
                    <h2>오늘의 인기글</h2>
                </div>
                <ul>
                    <?php foreach($best as $key => $item ) : ?>
                        <?php if($key <= 5) : ?>
                        <li><a href="/view?idx=<?=$item->idx?>"><span><?=$key+1?></span><p><?= $item->title ?></p></a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="board_list">
            <table>
                <tr>
                    <th width="60%">제목</th>
                    <th width="10%">작성자</th>
                    <th width="30%">작성일</th>
                </tr>
                <?php foreach($notice as $item) : ?>
                    <tr class="notice" onclick="location.href='/notice/view?idx=<?=$item->idx?>'" style="cursor:pointer;">
                        <td>공지) <?= $item->title?></td>
                        <td>관리자</td>
                        <td><?= $item->date?></td>
                    </tr>
                <?php endforeach; ?>
                <?php foreach($list as $item) : ?>
                <tr>
                    <td><a href="/view?idx=<?= $item->idx ?>"><?= $item->title?></a></td>
                    <td class="tc"><a href="/profile&id=<?=$item->writer?>"><?= $item->name ?></a></td>
                    <td class="tc"><?= $item->date?></td>
                </tr>
                <?php endforeach; ?>

            </table>
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
