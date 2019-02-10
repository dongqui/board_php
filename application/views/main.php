

<div class="main">
    <ul class="post-list-container">
        <?php foreach($postList as $post) { ?>
            <li class="post-list" onclick="window.location='<?php echo base_url()?>index.php/post/get/<?=$post->PK_POST_ID?>'">

                <dl>
                    <dt id="post-list-title" class=post-list-title ><?=$post->title?></dt>
                    <dd class=post-list-subtitle ><?=$post->subtitle?></dd>
                </dl>

                <dl>
                    <dt class=post-list-title><h5 id="post-list-autor"><?=$post->author?></h5></dt>
                    <dd class=post-list-subtitle id="post-list-date"><?=$post->created_time?></dd>
                </dl>

            </li>
        <?php } ?>
    </ul>
</div>

