
<div class="register-container">
    <form action="/index.php/auth/register" method="post">
        <div class="register-input-group">
            <label for="register-input-id">아이디</label>
            <input type="text" class="register-input" id="register-input-id" name="userId" placeholder="">

            <label for="register-input-email">이메일</label>
            <input type="email" class="register-input" id="register-input-email" name="email"  placeholder="">

            <label for="register-input-password">비밀번호</label>
            <input type="password" class="register-input" id="register-input-password" name="password" placeholder="">

            <label for="register-input-passwordCheck">비밀번호 확인</label>
            <input type="password" class="register-input" id="registerinput-passwordCheck" name="passwordCheck"  placeholder="">
        </div>
        <input type="submit" class="btn btn-primary register-btn" value="가입 신청" />
    </form>
</div>