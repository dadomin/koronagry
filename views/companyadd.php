<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<form action="/company/add/ok" method="post" enctype="multipart/form-data">
<section id="write">

    <h1>업체 추가하기</h1>
    <div class="line"></div>

    <p>업체 이름</p>
    <input type="text" placeholder="업체 이름을 입력해주세요." name="name">

    
    <p>업체 주소</p>
    <input type="text" placeholder="업체 주소를 입력해주세요." name="address" readonly style="margin-bottom: 12px;">
    <input type="text" placeholder="세부 주소를 입력해주세요." name="sub-address">

    <p>업체 정보</p>
    <textarea name="info" id="" cols="30" rows="10"></textarea>

    <p>업체 사진</p>
    <input type="file" placeholder="글의 제목을 입력해주세요." name="file">
    <button class="btn">작성 완료</button>

</section>
</form>
<script>
    $("input[name='address']").on('click', (e)=>{
        new daum.Postcode({
            oncomplete: function(data) {
                console.log(data.address);
                $(e.target).val(data.address);
            }
        }).open();
    });
    
</script>