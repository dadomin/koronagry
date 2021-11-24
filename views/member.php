<section id="member">
    <h1 class="tc">회원관리</h1>
    <div class="line"></div>

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