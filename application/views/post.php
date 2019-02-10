<div id="post-container">
    <h1 id="post-title"><?=$post->title?></h1>
    <h2 id="post-subtitle"><?=$post->subtitle?></h2>
    <div class="post-info-group">
        <p id="post-author"><?=$post->author?></p>
        <p id="post-date"><?=$post->created_time?></p>
        <?php if($this->session->userdata('PK_USER_ID') === $post->userId) {   ?>
            <a class="post-update-btn" href="/index.php/post/update/<?=$post->PK_POST_ID?>"> 글 수정 </a>  /
            <a class="post-update-btn" onclick="postDeleteHandler(event)"> 글 삭제 </a>
        <?php } ?>
    </div>
    <p id="post-content" class="lead"><?=$post->content?></p>


    <ul id="comment-list-container">
        <h3>댓글</h3>
        <?php foreach($commentList as $comment) { ?>
            <li class="comment-list" id="comment_<?=$comment->PK_COMMENT_ID?>">
                <p class="lead" id="comment-content"><?=$comment->content?></p>
                <span id="comment-autor"><?=$comment->author?></span>
                <span id="comment-date"><?=$comment->created_time?></span>
                <?php if($this->session->userdata('PK_USER_ID') === $comment->userId) {   ?>
                <div class="comment-update-btn-group">
                    <span onclick="commentUpdateHandler(<?=$comment->PK_COMMENT_ID?>)" class="comment-update-btn">수정</span>  /
                    <span onClick="commentDeleteHandler(<?=$comment->PK_COMMENT_ID?>)" class="comment-update-btn">삭제</span>
                </div>
                <?php } ?>
            </li>
        <?php } ?>
    </ul>

    <div id="comment-input-group">
        <textarea id="comment-input" type="text" id="comment"></textarea>
        <button id="comment-input-btn" class="btn btn-primary" onclick="commentAddHandler()">댓글 쓰기</button>
    </div>
</div>



<script>

    function postDeleteHandler(event) {
        event.preventDefault();
        if (confirm("정말 삭제 하시겠습니까?")) {
            window.location.href = '/index.php/post/delete/<?=$post->PK_POST_ID?>'
        }
    }

    function commentAddHandler() {
        $.ajax({
            url: '/index.php/comment/add',
            type: 'POST',
            data: {
                content: $('#comment-input').val(),
                postId: <?=$post->PK_POST_ID?>,

            },
            success: function (data) {
                commentsTemplete(data);
            },
            error: function (data) {
                alert(data);
            }
        });
    }

    function commentUpdateHandler(commentId) {
        let content = $("#comment_" + commentId + " .post-list-body h3").text();
        $("#comment_" + commentId + " .post-list-body").html('');
        $("#comment_" + commentId + " .post-list-body").append(`<input type="text" id="comment" value=${content}/>`);
        $("#comment_" + commentId + " .post-list-footer").html('');
        $("#comment_" + commentId + " .post-list-footer").append(`
        <button onclick="commentUpdateRequestHandler(${commentId})" class="ok">ok</button>`);
        $("#comment_" + commentId + " .post-list-footer").append(`
        <button onclick="commentUpdateHandler(${commentId})" class="cancel">cancel</button>`);
    }

    function commentUpdateRequestHandler(commentId) {
        console.log(commentId);
        $.ajax({
            url: '/index.php/comment/update/' + commentId ,
            type: 'POST',
            data: {content: $('#comment-input').val(), postId: <?=$post->PK_POST_ID?>},
            success: function (data) {
                commentsTemplete(data);
            },
            error: function (data) {
                alert(data);
            }
        });
    }

    function commentDeleteHandler(commentId) {
        $.ajax({
            url: "/index.php/comment/delete/" + commentId,
            type: 'POST',
            data: {postId: <?=$post->PK_POST_ID?>},
            success: function (data) {
                commentsTemplete(data);
            },
            error: function (data) {
                alert(data);
            }
        });
    }

    function commentsTemplete(data) {
        let comments = JSON.parse(data);
        let PK_USER_ID = <?php echo $this->session->userdata('PK_USER_ID') ?> + "" ;
        $('#comment-list-container').html('');
        comments.forEach(comment => {
            $('#comment-list-container').append(`
                        <li class="comment-list" id="comment_${comment.PK_COMMENT_ID}">
                            <p class="lead" id="comment-content">${comment.content}</p>
                            <span id="comment-autor">${comment.author}</span>
                            <span id="comment-date">${comment.created_time}</span>
                        </li>
             `);
            if (PK_USER_ID === comment.userId) {
                $(`#comment_${comment.PK_COMMENT_ID}`).append(`
                    <div class="comment-update-btn-group">
                        <span onclick="commentUpdateHandler(${comment.PK_COMMENT_ID})" class="comment-update-btn">수정</span>  /
                        <span onClick="commentDeleteHandler(${comment.PK_COMMENT_ID})" class="comment-update-btn">삭제</span>
                    </div>
                `)
            }
        });
        $('#comment-input').val('')
    }

</script>