<div class="section_top">
    
    <?php if(isset($_SESSION['user']) && $user->id == $pu->id) : ?>
        <h1>마이페이지</h1>
    <?php else : ?>    
        <h1><?= $pu->name ?>님의 페이지</h1>
    <?php endif; ?>
</div>
<section id="profile">
    <?php if(isset($_SESSION['user']) && $user->id == $pu->id) : ?>
        <div class="profile_img">
            <img src="<?= $user->img ?>" alt="">
        </div>
        
        <form action="/profile/change" method="post" enctype="multipart/form-data">
            <p>프로필 이미지 바꾸기</p>
            <input type="file" id="file" accept='image/jpg,image/png,image/jpeg,image/gif' name="file" >

            <p>아이디</p>
            <input type="text" value="<?= $user->id ?>" readonly name="id">

            <p>이름</p>
            <input type="text" value="<?= $user->name ?>" name="name">

            <p>비밀번호</p>
            <input type="password" value="<?= $user->pw ?>" name="pw">

            <p>비밀번호 확인</p>
            <input type="password" placeholder="변경할 비밀번호를 다시 입력해주세요." name="pwcheck">

            <p>보유한 포인트</p>
            <input type="text" disabled value="<?= $user->point ?>">
            <button class="btn">회원정보 수정하기</button>
        </form>
        
            
    <?php else : ?>
        <div class="profile_img">
            <img src="<?= $pu->img ?>" alt="">
        </div>

        <p>아이디</p>
        <input type="text" value="<?= $pu->id ?>" disabled>
        
        <p>이름</p>
        <input type="text" value="<?= $pu->name ?>" disabled>
        
        <p>보유한 포인트</p>
        <input type="text" disabled value="<?= $pu->point ?>">

        <?php if(isset($_SESSION['user']) && $user->id == 'admin') : ?>
            <form action="/member/delete" method="post">
                <input type="hidden" name="id" value="<?=$pu->id?>">
                <button class='btn'>강제 퇴장</button>
            </form>
        <?php endif; ?>

    <?php endif; ?>
</section>