<div class="section_top">
    <h1>신고 관리</h1>
</div>

<section id="admin">
    <h1 class="title"><span>신고 내용</span></h1>

    <div class="dn">
        <input type="radio" name="r" id="radio_board" checked>
        <input type="radio" name="r" id="radio_comment">
    </div>
    <div id="report-title">
        <label for="radio_board">게시글</label>
        <label for="radio_comment">댓글</label>
    </div>

    <div class="board_list">
        <table>
            <tr>
                <th width="5%">No.</th>
                <th width="50%">글 제목</th>
                <th width="20%">신고자</th>
                <th width="30%">신고날짜</th>
            </tr>
            <?php foreach($board as $item) : ?>
                <tr>
                    <td class="tc"><?=$item->idx?></td>
                    <td class="tc"><a href="/view?idx=<?= $item->board_idx ?>"><?= $item->title?></a></td>
                    <td class="tc"><a href="/profile&id=<?=$item->reporter?>"><?= $item->name ?></a></td>
                    <td class="tc"><?=$item->date?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <table>
            <tr>
                <th width="5%">No.</th>
                <th width="50%">댓글 내용</th>
                <th width="20%">신고자</th>
                <th width="30%">신고날짜</th>
            </tr>
            <?php foreach($comment as $item) : ?>
                <tr>
                    <td class="tc"><?=$item->idx?></td>
                    <td class="tc"><a href="/view?idx=<?= $item->board_idx ?>"><?= $item->sub?></a></td>
                    <td class="tc"><a href="/profile&id=<?=$item->reporter?>"><?= $item->name ?></a></td>
                    <td class="tc"><?=$item->date?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</section>
<script>
    function checkRadio(){
       $("input[type='radio']").each(function(idx){
            if($(`input[type='radio']:eq(${idx})`).is(":checked")) {
                let id = $(`input[type='radio']:eq(${idx})`).attr("id");
                $(`label[for='${id}']`).css("background-color", "#0f5e8b");
                $(`label[for='${id}']`).css("color", "#fff");
                $("table").eq(idx).show();
            }else {
                let id = $(`input[type='radio']:eq(${idx})`).attr("id");
                $(`label[for='${id}']`).css("background-color", "#efefef");
                $(`label[for='${id}']`).css("color", "#000");
                $("table").eq(idx).hide();
            }
       });
    }
    checkRadio();
    $("input[type='radio']").on("change", ()=>{
        checkRadio();
    });
</script>
