<?php
if($company->star == null) $company->star = 0; ?>
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
    <div class="company-review">
        <h1 class="title"><span>리뷰(<?=$cnt?>)</span><a>총점 <b><?=$company->star?>점</b> </a></h1>
        <form action="/review/add" method="post">
            <input type="hidden" name="company_idx" value="<?=$company->idx?>">
        <div class="review-write">
            <div>
                <div class="review-star">
                    <span>평점</span>
                    <select name="star" id="">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select><span>점</span>
                </div>
                <textarea name="comment" placeholder="평가내용을 입력하세요."id="" cols="30" rows="10"></textarea>
            </div>
            <button class="btn">리뷰 작성하기</button>
        </div>
        </form>
        <div class="review-list">
            <?php foreach($review as $item) : ?>
                <div class="review-box">
                    <div class="user-img">
                        <img src="<?=$item->img?>" alt="">
                    </div>
                    <div class ="review-sub">
                        <div>
                            <?php
                                $i = 1;
                                while($i<=5){
                                    if($i <= $item->star){
                                        echo "<i class='fas fa-star'></i>";
                                    }else {
                                        echo "<i class='far fa-star'></i>";
                                    }
                                    $i++;
                                }
                            ?>
                        </div>
                        <p class="review-name"><?=$item->name?><span>| <?=$item->date?></span></p>
                        <p class="review-comment"><?=$item->comment?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
