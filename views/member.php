<div class="section_top">
    <h1>회원관리하기</h1>
</div>
<section id="member">
    <h1 class="title"><span>회원 목록</span></h1>

    <div class="board_list">
        <table>
            <tr>
                <th width="33%">아이디</th>
                <th width="33%">이름</th>
                <th width="33%">포인트</th>
            </tr>

            <?php foreach($list as $item) : ?>
            <?php if($item->id != 'admin') : ?>
            <tr onclick="location.href='/profile&id=<?= $item->id ?>'">
                <td class="tc"><?= $item->id?></td>
                <td class="tc"><?= $item->name ?></td>
                <td class="tc"><?= $item->point?></td>
            </tr>
            <?php endif; ?>
            <?php endforeach; ?>

        </table>
    </div>
</section>