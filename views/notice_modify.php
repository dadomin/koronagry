<form action="/modify/notice/ok" method="post">
    
<section id="write">
    <h1>공지글 수정</h1>
    <div class="line"></div>
    
    <p>제목</p>
    <input type="text" placeholder="공지 글의 제목을 입력해주세요." name="title" value="<?= $list->title ?>">

    <p>본문</p>
    <textarea name="sub" placeholder="공지 글을 입력해주세요." cols="30" rows="10"><?= $list->sub ?></textarea>

    <button class="btn">완료</button>
    <input type="hidden" name="idx" value="<?=$list->idx?>">

</section>

</form>
