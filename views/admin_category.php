<div class="section_top">
    <h1>게시판 관리</h1>
</div>

<section id="admin">
    <h1 class="title"><span>카테고리 목록</span></h1>
    <div id="member_top">
        <form action="/admin/category/add" method="post">
            <h2>카테고리 추가하기</h2>
            <input type="text" name="name" placeholder="카테고리 이름을 입력해주세요.">
            <button class="btn">완료</button>
        </form>
    </div>

    <div class="board_list">
        <table>
            <tr>
                <th width="5%">No.</th>
                <th width="60%">카테고리명</th>
                <th width="10%">게시물 수</th>
                <th width="20%"></th>
                <th width="5%"></th>
            </tr>

            <?php foreach($list as $item) : ?>
                <tr>
                    <td class="tc"><?=$item->idx?></td>
                    <td class="tc"><?= $item->name?> </td>
                    <td class="tc"><?=$item->cnt?></td>
                    <td class="tc">
                        <button class="btn updateBtn">수정</button>
                        <form action="/admin/category/update" class="category_update_form" method="post">
                            <input type="hidden" name="idx" value="<?=$item->idx?>">
                            <input type="text" name="name">
                            <button class="btn-reverse">완료</button>
                        </form>
                    </td>
                    <td class="tc">
                        <form action="/admin/category/delete" method="post">
                            <input type="hidden" name="idx" value="<?=$item->idx?>">
                            <button class="btn-reverse"><i class="fas fa-minus-circle"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</section>

<script>
    $(".updateBtn").on("click", (e)=>{
        $(e.target).hide();
        $(e.target.parentNode).children("form").show();
    });
</script>