<!-- 페이지 관리 -->
<div id="left-top">
    <button id="open-manage" class="toggle-active" data-target="#page-manage">페이지 관리</button>
    <button id="save-site">사이트 저장</button>
    <a href="/logout">로그아웃</a>
    <div id="page-manage">
        <h3 class="title">페이지 관리</h3>
        <div class="table mt-4 mb-4">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Title</th>
                        <th colspan="2">Description</th>
                        <th>Keyword</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <button class="btn btn-add">페이지추가</button>
    </div>
</div>

<!-- 페이지 수정 팝업 -->
<div id="page-edit">
    <div class="padding">
        <div class="section-title title-sm">
            <h1>페이지 수정</h1>
        </div>
        <form class="mt-5" autocomplete="off">
            <input type="hidden" id="prev-code" name="prev-code">
            <div class="form-group">
                <label for="site-code">Site Code</label>
                <input type="text" id="site-code" name="code" class="form-control">
            </div>
            <div class="form-group">
                <label for="site-name">Site Name</label>
                <input type="text" id="site-name" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="site-title">Title</label>
                <input type="text" id="site-title" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="site-title">Description</label>
                <input type="text" id="site-description" name="description" class="form-control">
            </div>
            <div class="form-group">
                <label for="site-keyword">Keyword</label>
                <input type="text" id="site-keyword" name="keyword" class="form-control">
            </div>
            <button class="btn btn-filled mt-3">수정하기</button>
        </form>
    </div>
</div>

<!-- 페이지 제작 -->
<button id="open-create" class="toggle-active" data-target="#page-create">페이지 제작</button>
<div id="page-create">
    <div class="tool-list">
        <div class="tool">
            <div class="name toggle-active" data-overlap="#page-create .tool .name">Visual</div>
            <div class="preview-list">
                <div class="image cover" data-name="Visual_1">
                    <img src="/template_preview/Visual_1.jpg" alt="Visual_1">
                </div>
                <div class="image cover" data-name="Visual_2">
                    <img src="/template_preview/Visual_2.jpg" alt="Visual_2">
                </div>
            </div>
        </div>
        <div class="tool">
            <div class="name toggle-active" data-overlap="#page-create .tool .name">Features</div>
            <div class="preview-list">
                <div class="image cover" data-name="Features_1">
                    <img src="/template_preview/Features_1.jpg" alt="Features_1">
                </div>
                <div class="image cover" data-name="Features_2">
                    <img src="/template_preview/Features_2.jpg" alt="Features_2">
                </div>
            </div>
        </div>
        <div class="tool">
            <div class="name toggle-active" data-overlap="#page-create .tool .name">Gallery & Slider</div>
            <div class="preview-list">
                <div class="image cover" data-name="Gallery_1">
                    <img src="/template_preview/Gallery&Slide_1.jpg" alt="Gallery&Slide_1">
                </div>
                <div class="image cover" data-name="Gallery_2">
                    <img src="/template_preview/Gallery&Slide_2.jpg" alt="Gallery&Slide_2">
                </div>
            </div>
        </div>
        <div class="tool">
            <div class="name toggle-active" data-overlap="#page-create .tool .name">Contacts</div>
            <div class="preview-list">
                <div class="image cover" data-name="Contacts_1">
                    <img src="/template_preview/Contacts_1.jpg" alt="Contacts_1">
                </div>
                <div class="image cover" data-name="Contacts_2">
                    <img src="/template_preview/Contacts_2.jpg" alt="Contacts_2">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="wrap"></div>
<script src="/js/apps.js"></script>