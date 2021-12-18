<div class="section_top">
    <h1>회원관리하기</h1>
</div>
<section id="member">
    <h1 class="title"><span>회원 목록</span></h1>

    <div id="member_top">
        
        <form action="/point" method="post">
            <h2>포인트 지급하기</h2>
            <input type="number" placeholder="지급 포인트" name="point">
            <button class='btn'>지급하기</button>
            
            <div class="dn">
            <?php foreach($list as $item) : ?>

            <?php if($item->id != 'admin') : ?>
                <input type="checkbox" name="id[]" value="<?=$item->id?>" id="member_<?=$item->id?>">
                
            <?php endif; ?>
            <?php endforeach; ?>
            
            </div>
        </form>

        <form action="/admin/point" method="post">
            <h2>좋아요 기능</h2>
            <input type="number" value="<?=$point?>" name="point">
            <button class='btn'>변경하기</button>
        </form>
    </div>


    <div class="board_list">
        <table>
            <tr>
                <th width="1%"></th>
                <th width="30%">아이디</th>
                <th width="30%">이름</th>
                <th width="30%">포인트</th>
                <th width="9%"></th>
            </tr>

            <?php foreach($list as $item) : ?>
            <?php if($item->id != 'admin') : ?>
            <tr>
                <td class="tc"><label for="member_<?=$item->id?>"><i class="far fa-star"></i></label></td>
                <td class="tc"><?= $item->id?></td>
                <td class="tc"><?= $item->name ?></td>
                <td class="tc"><?= $item->point?></td>
                <td class="tc"><button onclick="location.href='/profile&id=<?= $item->id ?>'" class="btn">바로가기</button></td>
            </tr>
            <?php endif; ?>
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