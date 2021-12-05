
<div class="section_top">
    <h1>로그인</h1>
</div>
<form action="/login/check" method="post">
<section id="user_form">
    <h1 class="title"><span>회원 로그인</span></h1>
    

    <p>아이디</p>
    <input type="text" placeholder="아이디를 입력해주세요." name="id">

    <p>비밀번호</p>
    <input type="password"  placeholder="비밀번호를 입력해주세요." name="pw">

    <button type="button" onclick="logincheck()" class="btn">로그인</button>
    <input type="submit" class="dn">
</section>
</form>

