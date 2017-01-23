<?php
//상단광고
//랜덤으로 광고 출력
$value = rand(1,3); //1~3의 랜덤값

switch ($value){
    case 1: ?>
    <img id="top_Ad_img" src="/img/ad01.jpg">
    <a id="Xbox" type="button" onclick="deleteAd()"><img class="ad_img" src="/img/xbox.png"></a>

  <?php break;
        case 2: ?>
    <img id="top_Ad_img" src="/img/ad02.jpg">
    <a id="Xbox" type="button" onclick="deleteAd()"><img class="ad_img" src="/img/xbox.png"></a>

  <?php break;
        case 3: ?>

    <img id="top_Ad_img" src="/img/ad03.jpg">
    <a id="Xbox" type="button" onclick="deleteAd()"><img class="ad_img" src="/img/xbox.png"></a>

    <?php break; }?>
