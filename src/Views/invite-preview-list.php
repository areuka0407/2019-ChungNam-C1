<div class="simple-container no-center">
    <div class="simple-title">
        <h1>Invitation Preview</h1>
        <small>초대장 미리보기 목록</small>
    </div>
    <table class="text-center auto w-100">
        <thead>
            <tr>
                <th>행사명</th>
                <?php foreach($thead as $th):?>
                    <th><?=$th?></th>
                <?php endforeach;?>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($tbody as $tr):?>
            <tr>
                <td><?=$festival?></td>
                <?php foreach($tr as $td):?>
                <td><?=$td?></td>
                <?php endforeach;?>
                <td class="py-3">
                    <a href="/admin/invite-preview<?=toQueryString(["name" => $tr[1], "email" => $tr[2], "festival" => $festival, "code" => $code, "invitecode" => $tr[0]])?>"  class="btn p-2">초대장미리보기</a>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>