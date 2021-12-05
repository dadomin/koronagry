<section class="section_top">
    <h1>글쓰기</h1>
</section>
<form action="/write/ok" method="post" enctype="multipart/form-data">
    
<section id="write">
    <h1 class="title"><span>글 작성하기</span></h1>
    <p>카테고리</p>
    <select name="category">
        <option <?php if($category == 1) : ?> selected <?php endif; ?> value="1">카테고리1</option>
        <option <?php if($category == 2) : ?> selected <?php endif; ?> value="2">카테고리2</option>
        <option <?php if($category == 3) : ?> selected <?php endif; ?> value="3">카테고리3</option>
        <option <?php if($category == 4) : ?> selected <?php endif; ?> value="4">카테고리4</option>
        <option <?php if($category == 5) : ?> selected <?php endif; ?> value="5">카테고리5</option>
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
