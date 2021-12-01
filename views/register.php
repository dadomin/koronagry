
<form action="/register/check" method="post" enctype="multipart/form-data">
<section id="user_form">
    <h1>회원가입</h1>
    
    <div class="line"></div>

    <p>아이디</p>
    <input type="text" placeholder="아이디를 입력해주세요." name="id">
    
    <p>이름</p>
    <input type="text" placeholder="이름을 입력해주세요." name="name">

    <p>이메일</p>
    <div class="email">
        <input type="text" placeholder="ex) example@000.com"><button disabled class="btn">인증</button>
    </div>

    <p>비밀번호</p>
    <input type="password"  placeholder="비밀번호를 입력해주세요." name="pw">
    
    <p>비밀번호 확인</p>
    <input type="password"  placeholder="비밀번호를 입력해주세요." name="pwcheck">

    <p>프로필 사진</p>
    <div class="filebox">
        <input type="text" class="upload-name" value="파일선택" disabled="disabled">
        <label for="file">업로드</label>
        <input type="file" id="file" accept='image/jpg,image/png,image/jpeg,image/gif' name="file">
    </div>

    <button type="button"class="btn" onclick="regicheck()">회원가입 완료</button>
    <input type="submit" class="dn">
</section>
</form>