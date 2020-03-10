<div id="stats">
    <div class="nav">
        <!-- 네비게이션 -->
        <div class="nav-list" lang="en">
            <a href="/admin/table-stats/<?=$site->code?>" class="nav-item">TABLE</a>
            <a href="/admin/graph-stats/<?=$site->code?>" class="nav-item active">GRAPH</a>
        </div>
        <!-- 검색창 -->
        <form method="GET" autocomplete="off" class="search">
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
    </div>
    <div class="s-wrap">
    </div>
</div>