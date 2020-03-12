<?php
$https = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== "off" && $_SERVER['SERVER_PORT'] === 443;
?>

<div id="invite-preview">
    <div class="invite-code"><?=$invitecode?></div>
    <div class="title">
        <h1><?=$festival?></h1>
        <h2>당신을 초대합니다</h2>
    </div>
    <div class="body mt-5">
        <p class="mb-3">안녕하세요. 즐겁고 신나는 분위기를 자랑하는 <b><?=$festival?></b> 행사에 
            <?=$name?>님(<?=$email?>)을 초대합니다.  초청자 분들을 위한 다양한 프로젝트가 
            마련되어 있사오니 참여하여 행복한 시간을 보내시기 바랍니다.
            자세한 사항은 아래의 링크를 통해 살펴 보실 수 있습니다.</p>
        <a href="<?=$https ? "https://" : "http://"?><?=$_SERVER['HTTP_HOST']?>/<?=$code?>" class="site-link"><?=$https ? "https://" : "http://"?><?=$_SERVER['HTTP_HOST']?>/<?=$code?></a>
    </div>
</div>