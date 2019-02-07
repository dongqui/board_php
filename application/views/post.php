<div class="post-container">
    제목: <h2><?=$post->title?></h2>
    설명: <h2><?=$post->description?></h2>
    내용: <h2><?=$post->content?></h2>
    <a href="/index.php/post/update/<?=$post->PK_POST_ID?>"> 수정 </a>
</div>

<div>
    <ul id="post-list-container">
        <?php foreach($commentList as $comment) { ?>
            <li class="post-list" id="comment_<?=$comment->PK_COMMENT_ID?>">
                <div class="post-list-body">
                    <h3>
                        <?=$comment->content?>
                    </h3>
                </div>
                <div class="post-list-footer">
                    <p>
                        <?=$comment->created_time?>
                    </p>
                    <button onclick="commentUpdateHandler(<?=$comment->PK_COMMENT_ID?>)" class="update">update</button>
                    <button onClick="commentDeleteHandler(<?=$comment->PK_COMMENT_ID?>)" commentId="<?=$comment->PK_COMMENT_ID?>" class="delete">delete</button>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>

<div>
    내용: <input type="text" id="comment" />
    <button id="ajaxtest" onclick="commentAddHandler()">ajaxtest</button>
</div>

<script>

    function commentAddHandler() {
        $.ajax({
            url: '/index.php/comment/add',
            type: 'POST',
            data: {content: $('#comment').val(), postId: <?=$post->PK_POST_ID?>},
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
            data: {content: $('#comment').val(), postId: <?=$post->PK_POST_ID?>},
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
        console.log('ddd');
        let comments = JSON.parse(data);
        $('#post-list-container').html('');
        comments.forEach(comment => {
            $('#post-list-container').append(`
                        <li class="post-list" id="comment_${comment.PK_COMMENT_ID}">
                            <div class="post-list-body">
                                <h3>
                                    ${comment.content}
                                </h3>
                                <p>
                                    ${comment.created_time}
                                </p>
                            </div>
                            <div class="post-list-footer">
                                <button onClick="commentUpdateHandler(${comment.PK_COMMENT_ID})" class="update">update</button>
                                <button onclick="commentDeleteHandler(${comment.PK_COMMENT_ID})" commentId=${comment.PK_COMMENT_ID} class="delete">delete</button>
                            </div>
                        </li>
                    `)
        });
    }
</script>