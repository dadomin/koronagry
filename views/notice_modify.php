<div class="section_top">
    <h1>공지글 수정</h1>
</div>
<form action="/modify/notice/ok" method="post">
    
<section id="write">
    <h1 class="title"><span>공지글 수정하기</span></h1>
    
    <p>제목</p>
    <input type="text" placeholder="공지 글의 제목을 입력해주세요." name="title" value="<?= $list->title ?>">

    <p>본문</p>
    <textarea name="sub" placeholder="공지 글을 입력해주세요." cols="30" rows="10"><?= $list->sub ?></textarea>

    <button class="btn">완료</button>
    <input type="hidden" name="idx" value="<?=$list->idx?>">

</section>

</form>
