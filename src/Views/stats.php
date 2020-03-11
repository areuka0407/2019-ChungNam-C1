<div id="stats">
    <div class="nav">
        <!-- 프로필 창 -->
        <div class="profile">
            <div>
                <h2><a href="/<?=$site->code?>" class="name"><?=$site->name?></a></h2>
                <small class="d-block text-muted mt-1"><?=$site->code?></small>
            </div>
            <div class="mt-3">
                <p><?=$site->description?></p>
            </div>
            <div class="mt-5">
                <a href="/<?=$site->code?>" class="btn">사이트 바로가기</a>
                <a href="/admin/teaser_builder.html?code=<?=$site->code?>" class="btn">수정하기</a>
            </div>
        </div>
        <hr class="my-2">
        <!-- 검색창 -->
        <form method="get" autocomplete="off" class="search">
            <div class="title" lang="en">Search Range</div>
            <div class="form-group">
                <label for="from-date">시작일</label>
                <input type="text" id="from-date" name="from-date" class="form-control" required placeholder="ex. 2020-03-10">
            </div>
            <span class="accent">~</span>
            <div class="form-group">
                <label for="to-date">종료일</label>
                <input type="text" id="to-date" name="to-date" class="form-control" required placeholder="ex. 2020-03-13">
            </div>
            <div class="form-group">
                <button id="btn-search" class="btn w-100 mt-3">검색</button>
            </div>
        </form>
        <!-- 네비게이션 -->
        <hr class="my-3">
        <div class="nav-list" lang="en">
            <div class="title text-center" lang="en">Search Type</div>
            <a href="/admin/site-stats/referer/<?=$site->code?>" class="nav-item<?= $typeName === "유입경로" ? " active" : "" ?>">유입경로 별</a>
            <a href="/admin/site-stats/os/<?=$site->code?>" class="nav-item<?= $typeName === "운영체제" ? " active" : "" ?>">운영체제 별</a>
            <a href="/admin/site-stats/browser/<?=$site->code?>" class="nav-item<?= $typeName === "브라우저" ? " active" : "" ?>">브라우저 별</a>
            <a href="/admin/site-stats/device/<?=$site->code?>" class="nav-item<?= $typeName === "디바이스" ? " active" : "" ?>">디바이스 별</a>
        </div>
    </div>
    <div class="s-wrap">
        <div class="row align-items-center">
            <div class="w-50 px-2">
                <h3 class="title mb-2"><?=$typeName?>별 접속자 수</h3>
                <img src="/admin/bar-graph/<?=$type?>/<?=$site->code?><?=$queryString?>" alt="접속자 수 그래프">
            </div>
            <div class="w-50 px-2">
                <table class="mt-2">
                    <thead>
                        <tr>
                            <th><?=$typeName?></th>
                            <th>접속자 수</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($info->each as $item): ?>
                            <tr>
                                <td><?=$item[0]?></td>
                                <td><?=$item[1]?></td>
                            </tr>
                        <?php endforeach;?>
                        <tr class="active">
                            <td>합계</td>
                            <td><?=$info->all?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr class="my-4">
        <div class="row align-items-center mt-2">  
            <div class="w-50 px-2">
                <h3 class="title mb-2"><?=$typeName?>별 비율</h3>
                <img src="/admin/bar-graph/<?=$type?>/<?=$site->code?><?=$queryString?>" alt="접속자 수 그래프">
            </div>
            <div class="w-50 px-2">
            <table class="mt-2">
                    <thead>
                        <tr>
                            <th><?=$typeName?></th>
                            <th>접속자 비율</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($info->percent as $item):?>
                            <tr>
                                <td><?=$item[0]?></td>
                                <td><?=$item[1]?>%</td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>