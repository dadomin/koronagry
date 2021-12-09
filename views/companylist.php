<div class="section_top">
    <h1>업체 소개</h1>
</div>
<section id="company-list">

    <h1 class="title"><span>업체 목록</span><a href="/company/add" class="bold">+ 추가하기</a></h1>

    <div class="companies">

        <?php foreach($list as $item) : ?>
            <div class="company">
                <div class="company-img">
                    <?php if($item->img == null) : ?>
                        <img src="./img/noimg.png" alt="">
                    <?php else : ?>
                        <img src="<?=$item->img?>" alt="">
                    <?php endif; ?>
                </div>
                <div class="company-info">
                    <ul>
                        <li><span>이름</span><p><?= $item->name ?></p></li>
                        <li><span>주소</span><p><?= $item->address ?> <?= $item->sub_address?></p></li>
                        <li><span>정보</span><p><?= $item->info?></p></li>
                    </ul>
                </div>
                <div class="company-star">
                    <?php  if($item->star == null) :  ?>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                    <?php else : ?>
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
                   <?php endif; ?>
                </div>
                <button>
                    <a href="/company&idx=<?= $item->idx ?>">Go <i class="fas fa-chevron-right"></i></a>
                        </button>
            </div>
        <?php endforeach; ?>
    </div>

</section>