
<div class="register-container">
    <form action="/index.php/auth/register" method="post">
        <div class="register-input-group">
            <label for="register-input-id">아이디</label>
            <div id="register-id-group">
                <input type="text" id="register-input-id" value="<?php echo set_value('username'); ?>" name="userId" placeholder="">
                <button type="button" id="register-idCheck-btn" onclick="checkIdDuplication()" class="btn btn-primary btn-s" >중복 확인</button>
            </div>

            <label for="register-input-email">이메일</label>
            <input type="email" class="register-input" value="<?php echo set_value('email'); ?>" id="register-input-email" name="email"  placeholder="">

            <label for="register-input-password">비밀번호</label>
            <input type="password" class="register-input" value="<?php echo set_value('password'); ?>" id="register-input-password" name="password" placeholder="">

            <label for="register-input-passwordCheck">비밀번호 확인</label>
            <input type="password" class="register-input" value="<?php echo set_value('passwordCheck'); ?>" id="registerinput-passwordCheck" name="passwordCheck"  placeholder="">
        </div>
        <input type="submit" class="btn btn-primary register-btn" value="가입 신청" />
    </form>
</div>

<script defer>
    function checkIdDuplication() {
        let userId = $('#register-input-id').val();
        $.ajax({
            url: '/index.php/auth/userIdCheck',
            type: 'POST',
            data: { userId }
            success: function (isPossible) {
                if (JSON.parse(isPossible)) {
                    alert('사용 가능한 아이디입니다!');
                } else {
                    alert('사용 불가능한 아이디입니다!');
                }
            },
            error: function (data) {
                alert(data);
            }
        });
    }
</script>
