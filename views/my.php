<div class="section_top">
    <h1>내가 작성한 게시물</h1>
</div>
<section id="my">
    <h1 class="title"><span>게시물 목록</span><a href="/write">+ 글쓰기</a></h1>
    
    <div class="board_list">
        <table>
            <tr>
                <th width="60%">제목</th>
                <th width="10%">작성자</th>
                <th width="30%">작성일</th>
            </tr>

            <?php foreach($list as $item) : ?>
            <tr>
                <td><a href="/view?idx=<?= $item->idx ?>"><?= $item->title?></a></td>
                <td class="tc"><a href="/profile&id=<?=$item->writer?>"><?= $item->name ?></a></td>
                <td class="tc"><?= $item->date?></td>
            </tr>
            <?php endforeach; ?>

        </table>
    </div>
</section>