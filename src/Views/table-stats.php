<div id="stats">
    <div class="nav">
        <!-- 네비게이션 -->
        <div class="nav-list" lang="en">
            <a href="/admin/table-stats/<?=$site->code?>" class="nav-item active">TABLE</a>
            <a href="/admin/graph-stats/<?=$site->code?>" class="nav-item">GRAPH</a>
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
        <h3 class="title mb-2">사이트 접속 기록</h3>
        <div class="all-table">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>접속 IP</th>
                        <th>유입 경로(Referer-URL)</th>
                        <th>운영체제</th>
                        <th>브라우저</th>
                        <th>Mobile / PC</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>127.0.0.1</td>
                        <td>https://naver.com</td>
                        <td>Window 10</td>
                        <td>Chrome 80.0.3987.132 (32Bit)</td>
                        <td>PC</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>127.0.0.1</td>
                        <td>https://naver.com</td>
                        <td>Window 10</td>
                        <td>Chrome 80.0.3987.132 (32Bit)</td>
                        <td>PC</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>127.0.0.1</td>
                        <td>https://naver.com</td>
                        <td>Window 10</td>
                        <td>Chrome 80.0.3987.132 (32Bit)</td>
                        <td>PC</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr class="my-4">
        <h3 class="title mb-2">분류별 접속자 수</h3>
        <div class="row justify-content-between mt-2">
            <div class="col text-center">
                <h4 class="sub-title">유입경로별 접속자 수</h4>
                <table class="mt-2">
                    <thead>
                        <tr>
                            <th>접속 경로</th>
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
                    </tbody>
                </table>
            </div>
            <div class="col text-center">
                <h4 class="sub-title">운영체제별 접속자 수</h4>
                <table class="mt-2">
                    <thead>
                        <tr>
                            <th>접속 경로</th>
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
                    </tbody>
                </table>
            </div>
            <div class="col text-center">
                <h4 class="sub-title">브라우저별 접속자 수</h4>
                <table class="mt-2">
                    <thead>
                        <tr>
                            <th>접속 경로</th>
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
                    </tbody>
                </table>
            </div>
            <div class="col text-center">
                <h4 class="sub-title">디바이스별 접속자 수</h4>
                <table class="mt-2">
                    <thead>
                        <tr>
                            <th>접속 경로</th>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>