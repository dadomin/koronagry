<div class="section_top">
    
    <?php if(isset($_SESSION['user']) && $user->id == $pu->id) : ?>
        <h1>마이페이지</h1>
    <?php else : ?>    
        <h1><?= $pu->name ?>님의 페이지</h1>
    <?php endif; ?>
</div>

<section id="profile">
    
<?php if($pu->islimit) : ?>
    <p class="warning"><i class="fas fa-exclamation-triangle"></i> 현재 활동 정지가 되어있는 회원입니다.</p>
<?php endif; ?>
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

            <p style="margin-bottom:12px;">레벨</p>
            <div style="height: 45px; ">
            <?php if($pu->id == "admin") : ?>
                <img src='./img/level/sp.gif' alt=''style='margin-right: 5px; margin-bottom: 20px; margin-left:6px; display:inline-box; float:left;'>
                <span style="float:left;">Super</span>
            <?php elseif($pu->point >= end($level)->point) : ?>
                <img src='./img/level/<?=end($level)->level?>.gif' alt=''style='margin-right: 5px;margin-bottom: 20px; margin-left:6px; display:inline-box;float:left;'>
                <span style="float:left;"><?=end($level)->level?></span>
            <?php else: ?>
            <?php foreach($level as $l) : ?>
                <?php if($pu->point <= $l->point) : ?>
                    <img src='./img/level/<?=$l->level - 1?>.gif' alt=''style='margin-right: 5px;margin-bottom: 20px; margin-left:6px; display:inline-box;float:left;'>
                    <span style="float:left;"><?=$l->level?></span>
                <?php break; endif; ?>
            <?php endforeach; ?>
            <?php endif;?>
            </div>

            <p>보유한 포인트</p>
            <input type="text" disabled value="<?= $user->point ?>">
            <button class="btn">회원정보 수정하기</button>
        </form>
        
            
    <?php else : ?>
        <div class="profile_img">
            <img src="<?= $pu->img ?>" alt="">
        </div>

        <?php if(isset($_SESSION['user']) && $user->id == 'admin') : ?>
        <p>아이디</p>
        <input type="text" value="<?= $pu->id ?>" disabled>
        <?php endif;?>
        
        <p>이름</p>
        <input type="text" value="<?= $pu->name ?>" disabled>

        <p style="margin-bottom:12px;">레벨</p>
            <div style="height: 45px; ">
            <?php if($pu->id == "admin") : ?>
                <img src='./img/level/sp.gif' alt=''style='margin-right: 5px; margin-bottom: 20px; margin-left:6px; display:inline-box; float:left;'>
                <span style="float:left;">Super</span>
            <?php elseif($pu->point >= end($level)->point) : ?>
                <img src='./img/level/<?=end($level)->level?>.gif' alt=''style='margin-right: 5px;margin-bottom: 20px; margin-left:6px; display:inline-box;float:left;'>
                <span style="float:left;"><?=end($level)->level?></span>
            <?php else: ?>
            <?php foreach($level as $l) : ?>
                <?php if($pu->point <= $l->point) : ?>
                    <img src='./img/level/<?=$l->level - 1?>.gif' alt=''style='margin-right: 5px;margin-bottom: 20px; margin-left:6px; display:inline-box;float:left;'>
                    <span style="float:left;"><?=$l->level?></span>
                <?php break; endif; ?>
            <?php endforeach; ?>
            <?php endif;?>
            </div>
        
        <p>보유한 포인트</p>
        <input type="text" disabled value="<?= $pu->point ?>">

        <?php if(isset($_SESSION['user']) && $user->id == 'admin') : ?>
            <form action="/member/delete" method="post">
                <input type="hidden" name="id" value="<?=$pu->id?>">
                <button class='btn'>강제 퇴장</button>
            </form>
            <?php if($pu->islimit) : ?>
                <form action="/member/limit-none" method="post">
                    <input type="hidden" name="id" value="<?=$pu->id?>">
                    <button class='btn'>활동 제한 해제</button>
                </form>
            <?php else : ?>
                <form action="/member/limit" method="post">
                    <input type="hidden" name="id" value="<?=$pu->id?>">
                    <button class='btn'>활동 제한</button>
                </form>
            <?php endif; ?>
        <?php endif; ?>

    <?php endif; ?>
</section>