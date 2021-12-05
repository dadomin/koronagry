
<section class='section_top'>
    <h1>글 수정하기</h1>
</section>
<form action="/modify/board/ok" method="post" enctype="multipart/form-data">
    
<section id="write">
    <h1 class="title"><span>글 세부내용 수정하기</span></h1>
    
    <p>카테고리</p>
    <select name="category">
        <option <?php if($list->tag == 1) :?> selected <?php endif;?>value="1">카테고리1</option>
        <option <?php if($list->tag == 2) :?> selected <?php endif;?>value="2">카테고리2</option>
        <option <?php if($list->tag == 3) :?> selected <?php endif;?>value="3">카테고리3</option>
        <option <?php if($list->tag == 4) :?> selected <?php endif;?>value="4">카테고리4</option>
        <option <?php if($list->tag == 5) :?> selected <?php endif;?>value="5">카테고리5</option>
    </select>
    <p>제목</p>
    <input type="text" placeholder="글의 제목을 입력해주세요." name="title" value="<?=$list->title?>">

    <p>본문</p>
    <textarea name="sub" placeholder="본문을 입력해주세요." cols="30" rows="10"><?=$list->sub?></textarea>

    <?php if($imgs != null) : ?>
        <p>파일 삭제하기</p>
        <?php foreach($imgs as $item) : ?>
            <p class="img_name"><?= $item->file_name?> <input type="checkbox" name="imgs[]" value=<?=$item->idx?>></p>
        <?php endforeach; ?>
    <?php endif; ?>
    <p>파일 추가하기</p>
    <input type="file" placeholder="글의 제목을 입력해주세요." name="file[]" multiple>

    <?php if($list->youtube == null) : ?>
        <p>Youtube 링크 추가하기</p>
    <input type="text" placeholder="첨부하고자 하는 유투브 링크를 복사하여 넣으세요." name="link">
    <?php else : ?>
    <p>Youtube 링크 수정하기</p>
    <input type="text" placeholder="첨부하고자 하는 유투브 링크를 복사하여 넣으세요." name="link" value="https://www.youtube.com/watch?v=<?=$list->youtube?>">
    <?php endif; ?>

    <button class="btn">완료</button>
    <input type="hidden" name="idx" value="<?=$list->idx?>">

</section>

</form>

