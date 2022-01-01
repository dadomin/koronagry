<div class="section_top">
    <h1>회원관리하기</h1>
</div>
<section id="member">
    <h1 class="title"><span>회원 목록</span></h1>

    <div class="member_top">
        <form action="/admin/point/register" method="post">
            <h2>가입 포인트</h2>
            <input type="nunmber" name="point" value="<?=$point->register_up?>">
            <button class="btn">변경하기</button>
        </form>
        <form action="/admin/point/login" method="post">
            <h2>로그인 포인트</h2>
            <input type="nunmber" name="point" value="<?=$point->login_up?>">
            <button class="btn">변경하기</button>
        </form>
        <form action="/admin/point/write" method="post">
            <h2>글쓰기 포인트</h2>
            <input type="nunmber" name="point" value="<?=$point->write_up?>">
            <button class="btn">변경하기</button>
        </form>

        <form action="/admin/point/view" method="post">
            <h2>글조회 포인트</h2>
            <input type="nunmber" name="point" value="<?=$point->view_up?>">
            <button class="btn">변경하기</button>
        </form>
        <form action="/admin/point/like" method="post">
            <h2>추천받음 포인트</h2>
            <input type="nunmber" name="point" value="<?=$point->like_up?>">
            <button class="btn">변경하기</button>
        </form>

        

        <form action="/admin/point" method="post">
            <h2>좋아요 활성화</h2>
            <input type="number" value="<?=$point->point_level?>" name="point">
            <button class='btn'>변경하기</button>
        </form>

    </div>

    <div class="board_list">
        <h2>레벨 포인트</h2>
        <table>
            <tr>
                <th width="30%">레벨</th>
                <th width="30%">레벨아이콘</th>
                <th width="30%">포인트</th>
                <th width="10%"></th>
            </tr>
            
            <?php foreach($list as $item) : ?>
                <form action="/admin/level/modify" method="post">
                <tr>
                    <td class="tc"><?=$item->level?></td>
                    <td class="tc"><img src="/img/level/<?=$item->level?>.gif" alt=""></td>
                    <td class="tc"><input type="number" value="<?= $item->point?>" name="point"><input type="hidden"value="<?=$item->level?>"name="level"></td>
                    <td class="tc"><button class="btn">변경하기</button></td>
                </tr>
                </form>
            <?php endforeach; ?>
        </table>

    </div>

</section>

<script>
    
    $("input[type='checkbox']").on("change", (e)=>{
        let idx = $(e.target).index();
        if($(e.target).is(":checked")){
           console.log($("label").eq(idx));
           $("label").eq(idx).html('<i class="fas fa-star"></i>');
        }else {
            
           $("label").eq(idx).html('<i class="far fa-star"></i>');
        }
    });
    
</script>