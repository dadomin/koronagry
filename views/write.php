<section class="section_top">
    <h1>글쓰기</h1>
</section>
<form action="/write/ok" method="post" enctype="multipart/form-data">
    
<section id="write">
    <h1 class="title"><span>글 작성하기</span></h1>
    <p>카테고리</p>
    <select name="category">
        <?php foreach($list as $item) : ?>
            <option <?php if($category == $item->idx) : ?> selected <?php endif; ?> value="<?=$item->idx?>"><?=$item->name?></option>
        <?php endforeach; ?>
    </select>
    <p>제목</p>
    <input type="text" placeholder="글의 제목을 입력해주세요." name="title">

    <p>본문</p>
    <textarea name="sub" placeholder="본문을 입력해주세요." cols="30" rows="10"></textarea>

    <p>파일 첨부하기</p>
    <input type="file" placeholder="글의 제목을 입력해주세요." name="file[]" multiple>

    <p>Youtube 링크 첨부하기</p>
    <input type="text" placeholder="첨부하고자 하는 유투브 링크를 복사하여 넣으세요." name="link">

    <button class="btn">완료</button>

</section>

</form>
