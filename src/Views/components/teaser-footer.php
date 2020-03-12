<?php if(user()):?>
    <div id="left-bottom">
        <a href="/admin/teaser_builder.html">Teaser Builder</a>
        <a href="/admin/site-stats/referer/<?=$site->code?>" class="bg-white">접속 통계</a>
        <a href="/admin/invite-manager" class="bg-white">초대장 메일관리</a>
        <a id="logout" href="/logout">로그아웃</a>
    </div>
<?php endif;?>

<script src="/js/teaser.js"></script>
</body>
</html>