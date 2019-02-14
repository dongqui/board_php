<div id="post-container">
    <h1 id="post-title"><?=$post->title?></h1>
    <h2 id="post-subtitle"><?=$post->subtitle?></h2>
    <div class="post-info-group">
        <p id="post-author"><?=$post->userId?></p>
        <p id="post-date"><?=$post->created_time?></p>
        <?php if($this->session->userdata('PK_USER_ID') === $post->user_fk_Id) {   ?>
            <a class="post-update-btn" href="/index.php/post/update/<?=$post->PK_POST_ID?>"> 글 수정 </a>  /
            <a class="post-update-btn" onclick="postDeleteHandler(event)"> 글 삭제 </a>
        <?php } ?>
    </div>
    <p id="post-content" class="lead"><?=$post->content?></p>


    <ul id="comment-list-container">
        <h3>댓글</h3>
        <?php foreach($commentList as $comment) { ?>
            <li class="comment-list" id="comment_<?=$comment->PK_COMMENT_ID?>">
                <p class="lead comment-content" id="comment-content_<?=$comment->PK_COMMENT_ID?>"><?=$comment->content?></p>
                <span id="comment-autor"><?=$comment->userId?></span>
                <span id="comment-date"><?=$comment->created_time?></span>
                <?php if($this->session->userdata('PK_USER_ID') === $comment->user_fk_Id) {   ?>
                <div class="comment-update-btn-group">
                    <span onclick="commentUpdateHandler(<?=$comment->PK_COMMENT_ID?>)" data-toggle="modal" data-target="#myModal" class="comment-update-btn">수정</span>  /
                    <span onClick="commentDeleteHandler(<?=$comment->PK_COMMENT_ID?>)" class="comment-update-btn">삭제</span>
                </div>
                <?php } ?>
            </li>
        <?php } ?>
    </ul>

    <div id="comment-input-group">
        <textarea class="comment-input" id="comment-input"></textarea>
        <button id="comment-input-btn" class="btn btn-primary" onclick="commentAddHandler()">댓글 쓰기</button>
    </div>
</div>

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">댓글 수정</h4>
            </div>
            <div class="modal-body">
                <textarea class="comment-input" id="comment-input-update"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="commentUpdateRequestHandler()" id='modal-update-btn' class="btn btn-default" data-dismiss="modal">확인</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script defer>

    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').focus()
    });

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
                post_fk_Id: <?=$post->PK_POST_ID?>,

            },
            success: function (data) {
                appendCommentsTemplate(data);
            },
            error: function (data) {
                alert(data);
            }
        });
    }

    function commentUpdateHandler(commentId) {
        $(`#comment-input-update`).val($(`#comment-content_${commentId}`).text());
        $(`#modal-update-btn`).attr('commentId', commentId);
    }

    function commentUpdateRequestHandler() {
        const commentId = $(`#modal-update-btn`).attr('commentId');
        $.ajax({
            url: '/index.php/comment/update/' + commentId ,
            type: 'POST',
            data: {content: $('#comment-input-update').val(), post_fk_Id: <?=$post->PK_POST_ID?>},
            success: function (data) {
                $('#comment-input-update').val('');
                appendCommentsTemplate(data);
            },
            error: function (data) {
                alert(data);
            }
        });
    }

    function commentDeleteHandler(commentId) {
        if (confirm("정말 삭제 하시겠습니까?")) {
            commentDeleteRequestHandler(commentId);
        }
    }

    function commentDeleteRequestHandler(commentId) {
        $.ajax({
            url: "/index.php/comment/delete/" + commentId,
            type: 'POST',
            data: {post_fk_Id: <?=$post->PK_POST_ID?>},
            success: function (data) {
                appendCommentsTemplate(data);
            },
            error: function (data) {
                alert(data);
            }
        });
    }

    function appendCommentsTemplate(data) {
        let comments = JSON.parse(data);
        let PK_USER_ID = <?php echo $this->session->userdata('PK_USER_ID') ?> + "" ;
        $('#comment-list-container').html('<h3>댓글</h3>');
        comments.forEach(comment => {
            $('#comment-list-container').append(`
                        <li class="comment-list" id="comment_${comment.PK_COMMENT_ID}">
                            <p class="lead comment-content" id="comment-content_${comment.PK_COMMENT_ID}">${comment.content}</p>
                            <span id="comment-autor">${comment.userId}</span>
                            <span id="comment-date">${comment.created_time}</span>
                        </li>
             `);
            if (PK_USER_ID === comment.user_fk_Id) {
                $(`#comment_${comment.PK_COMMENT_ID}`).append(`
                    <div class="comment-update-btn-group">
                        <span onclick="commentUpdateHandler(${comment.PK_COMMENT_ID})" data-toggle="modal" data-target="#myModal" class="comment-update-btn">수정</span>  /
                        <span onClick="commentDeleteHandler(${comment.PK_COMMENT_ID})" class="comment-update-btn">삭제</span>
                    </div>
                `)
            }
        });
        $('#comment-input').val('')
    }


</script>