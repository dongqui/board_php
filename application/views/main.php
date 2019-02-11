

<div class="main">
    <ul id="post-list-container">
        <?php foreach($postList as $post) { ?>
            <li class="post-list" onclick="window.location='<?php echo base_url()?>index.php/post/get/<?=$post->PK_POST_ID?>'">

                <dl>
                    <dt id="post-list-title" class=post-list-title ><?=$post->title?></dt>
                    <dd id="post-list-subtitle" class=post-list-subtitle ><?=$post->subtitle?></dd>
                </dl>

                <dl>
                    <dt class=post-list-title><h5 id="post-list-author"><?=$post->userId?></h5></dt>
                    <dd class=post-list-subtitle id="post-list-date"><?=$post->created_time?></dd>
                    <h5 id="post-commentCount">댓글 : <?=$post->CommentCount?> </h5>
                </dl>

            </li>
        <?php } ?>
    </ul>
</div>

<script def>
    (function() {
        let offsetPage = 1;
        let count = <?=$count?>;
        let requestWithThrottle = throttle(requestHandlerWithScroll, 500);
        $(window).scroll(function() {
            if ($(window).scrollTop() === $(document).height() - $(window).height() && offsetPage <= count) {
                requestWithThrottle(offsetPage, function(){offsetPage++});
            }
        });
    })();

    function requestHandlerWithScroll(offsetPage, cb) {
        $.ajax({
            url: '/index.php/main/getList',
            type: 'POST',
            dataType : "json",
            data: { offsetPage },
            success: function (postList) {
                appendPostTemplateList(postList);
                cb();
            },
            error: function (data) {
                console.log(data);
            }
        });
    }

    function appendPostTemplateList(postList) {
        postList.forEach(post => {
            $('#post-list-container').append(postTemplate(post));
        });
    }

    function postTemplate(post) {
        return `
            <li class="post-list" onclick="window.location='<?php echo base_url()?>index.php/post/get/${post.PK_POST_ID}'">

                <dl>
                    <dt id="post-list-title" class=post-list-title >${post.title}</dt>
                    <dd class=post-list-subtitle >${post.subtitle}</dd>
                </dl>

                <dl>
                    <dt class=post-list-title><h5 id="post-list-autor">${post.userId}</h5></dt>
                    <dd class=post-list-subtitle id="post-list-date">${post.created_time}</dd>
                    <h5 id="post-commentCount">댓글 : ${post.CommentCount}</h5>
                </dl>

            </li>
        `
    }

    function throttle(func, time) {
        let wait = false;
        return function() {
            if (!wait) {
                wait = true;
                func.apply(null, arguments);
                setTimeout(function(){wait = false;}, time);
            }
        }
    }
</script>