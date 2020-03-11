<div id="stats">
    <div class="nav">
        <!-- 네비게이션 -->
        <div class="nav-list" lang="en">
            <a href="/admin/site-stats/<?=$site->code?>" class="nav-item active">유입경로 별</a>
            <a href="/admin/site-stats/<?=$site->code?>" class="nav-item">운영체제 별</a>
            <a href="/admin/site-stats/<?=$site->code?>" class="nav-item">브라우저 별</a>
            <a href="/admin/site-stats/<?=$site->code?>" class="nav-item">디바이스 별</a>
        </div>
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
    </div>
    <div class="s-wrap">
        <div class="row">
            <div class="w-50 px-2">
                <h3 class="title mb-2">유입경로별 접속자 수</h3>
                <div class="graph">

                </div>
            </div>
            <div class="w-50 px-2">
                <h3 class="title mb-2">유입경로별 비율</h3>
                <div class="graph">

                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="row mt-2">  
            <div class="w-50 px-2">
                <table class="mt-2">
                    <thead>
                        <tr>
                            <th>유입 경로</th>
                            <th>접속자 수</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>https://www.naver.com</td>
                            <td>515,353</td>
                        </tr>
                        <tr>
                            <td>https://www.youtube.com</td>
                            <td>512,125</td>
                        </tr>
                        <tr>
                            <td>https://www.daum.net</td>
                            <td>231,244</td>
                        </tr>
                        <tr>
                            <td>기타</td>
                            <td>125,351</td>
                        </tr>
                        <tr>
                            <td>합계</td>
                            <td>1,384,073</td>
                        </tr>   
                    </tbody>
                </table>
            </div>
            <div class="w-50 px-2">
            <table class="mt-2">
                    <thead>
                        <tr>
                            <th>유입 경로</th>
                            <th>접속자 비율</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>https://www.naver.com</td>
                            <td>37.23%</td>
                        </tr>
                        <tr>
                            <td>https://www.youtube.com</td>
                            <td>37.00%</td>
                        </tr>
                        <tr>
                            <td>https://www.daum.net</td>
                            <td>16.70%</td>
                        </tr>
                        <tr>
                            <td>기타</td>
                            <td>9.05%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>