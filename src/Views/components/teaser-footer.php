<?php if(user()):?>
    <div id="left-bottom">
        <a href="/admin/teaser_builder.html">Teaser Builder</a>
        <a href="/admin/table-stats/<?=$site->code?>" class="bg-white">접속 통계</a>
        <a id="logout" href="/logout">로그아웃</a>
    </div>
<?php endif;?>

<script src="/js/teaser.js"></script>
</body>
</html>