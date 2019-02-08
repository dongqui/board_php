<div class="login-container">
    <form action="/index.php/auth/loginCheck" method="post">
        <div class="login-input-group">
            <h4>아이디</h4>
            <input type="text" class="login-input" id="login-input-id" name="userId" placeholder="">
            <h4>비밀번호</h4>
            <input type="password" class="login-input" id="login-input-password" name="password"  placeholder="">
        </div>
        <input type="submit" class="btn btn-primary login-btn" value="로그인" />
    </form>
    <a href="/index.php/auth/register" class="btn btn-primary login-btn">회원가입</a>
</div>