<form class="form-horizontal" action="/index.php/auth/loginCheck" method="post">
    <div class="modal-body">


        <div class="control-group">
            <label class="control-label" for="userId">아이디</label>
            <div class="controls">
                <input type="text" id="userId" name="userId" placeholder="아이디">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="password">비밀번호</label>
            <div class="controls">
                <input type="password" id="password" name="password"  placeholder="비밀번호">
            </div>
        </div>


    </div>
    <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="로그인" />
    </div>
</form>