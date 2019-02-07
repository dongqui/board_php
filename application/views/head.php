<!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8"/>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
                <link href="/static/css/style.css" rel="stylesheet">
                <script src="http://code.jquery.com/jquery.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

            </head>
            <body>
                <div class="container">
                    <div class="nav">
                        <h2>ST UNITAS</h2>
                        <?php if($this->session->userdata('is_login')) {   ?>
                            <a class="nav-icon" href="/index.php/auth/login">
                                로그인
                            </a>
                        <?php } else {   ?>
                            <a class="nav-icon" href="/index.php/auth/logout">
                                로그아웃
                            </a>
                        <?php } ?>

                        <a class="nav-icon" href="/index.php/post">
                            글쓰기
                        </a>
                    </div>

