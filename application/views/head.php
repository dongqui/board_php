<!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8"/>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <script src="http://code.jquery.com/jquery.js"></script>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
                <link href="/static/css/footer.css" rel="stylesheet">
                <link href="/static/css/main.css" rel="stylesheet">
                <link href="/static/css/writePost.css" rel="stylesheet">
                <link href="/static/css/container.css" rel="stylesheet">
                <link href="/static/css/login.css" rel="stylesheet">
                <link href="/static/css/register.css" rel="stylesheet">
                <link href="/static/css/nav.css" rel="stylesheet">
                <link href="/static/css/post.css" rel="stylesheet">
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

            </head>
            <body>
                <div class="container">
                    <div class="nav">
                        <a href="/index.php/main">
                            <h2>ST UNITAS</h2>
                        </a>
                        <?php if($this->session->userdata('is_login')) {   ?>
                            <a class="nav-menu" href="/index.php/auth/logout">
                                로그아웃
                            </a>
                        <?php } else {   ?>
                            <a class="nav-menu" href="/index.php/auth/login">
                                로그인
                            </a>
                        <?php } ?>

                        <a class="nav-menu" href="/index.php/post">
                            글쓰기
                        </a>
                    </div>
                    <div class="body-contents">


