
<div class="section_top">
    <h1>업체 세부사항</h1>
</div>
    
<section id="company">
    <div class="company-detail">
        <h1 class="title"><span>업체이름</span></h1>
        <p><?= $company->name ?></p>
        
        <h1 class="title"><span>업체 대표사진</span></h1>
        <div class="company-detail-img">
            <?php if($company->img == null) : ?>
                <img src="./img/noimg.png" alt="">
            <?php else : ?>
                <img src="<?=$company->img?>" alt="">
            <?php endif; ?>
        </div>
        <div class="company-detail-sub">
            
            <h1 class="title"><span>주소</span></h1>
            <p><?=$company->address?> <?= $company->sub_address?></p>

            <h1 class="title"><span>세부정보</span></h1>
            <p><?=$company->info?></p>

        </div>
        <button class="btn" onclick="history.back()">뒤로가기</button>
    </div>
</section>