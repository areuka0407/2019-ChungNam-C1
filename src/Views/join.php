<div class="user-container">
    <div class="user-title">
        <h1 lang="en">SIGN UP</h1>
        <small>회원가입</small>
    </div>
    <form method="post" id="join" autocomplete="off">
        <div class="form-group">
            <label for="identity">아이디</label>
            <input type="text" id="identity" class="form-control" name="identity" required> 
        </div>
        <div class="form-group">
            <label for="password">비밀번호</label>
            <input type="password" id="password" class="form-control" name="password" required> 
        </div>
        <div class="form-group">
            <label for="name">성명</label>
            <input type="text" id="name" class="form-control" name="name" required> 
        </div>
        <div class="form-group">
            <label for="email">이메일</label>
            <input type="email" id="email" class="form-control" name="email" required> 
        </div>
        <div class="form-group">
            <small class="text-muted">계정이 이미 있으신가요? <a href="/admin">로그인</a></small>
            <button class="btn w-100 mt-2">회원가입</button>
        </div>
    </form>
</div>