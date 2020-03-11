<div class="simple-container">
    <div class="simple-title">
        <h1 lang="en">INVITE FORM</h1>
        <small>온라인초대장 메일관리</small>
    </div>
    <form action="/admin/invite-preview-list" method="post" id="join" autocomplete="off" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">행사명</label>
            <input type="text" id="name" class="form-control" name="name" required> 
        </div>
        <div class="form-group">
            <label for="code">행사 코드</label>
            <select name="code" id="code" class="form-control mt-1">
                <?php foreach($sites as $site):?>
                    <option value="<?=$site->code?>"><?=$site->name?>(<?=$site->code?>)</option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="invite-file">행사명</label>
            <input type="file" id="invite-file" class="custom-file" name="invite-file" required accept=".xlsx" required hidden>
            <label for="invite-file" class="custom-file mt-1"></label>
        </div>
        <div class="form-group">
            <button class="btn w-100 mt-2">미리보기</button>
        </div>
    </form>
</div>