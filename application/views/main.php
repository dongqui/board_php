
<div class="post-list-container">
    <ul>
        <?php foreach($postList as $post) { ?>
        <li class="post-list">
            <div class="post-list-head">
                <h3><?=$post->title?></h3>
            </div>
            <div class="post-list-body">
                <h3>
                    <?=$post->description?>
                </h3>
                <p>
                    <?=$post->content?>
                </p>
                <p>
                    <?=$post->created_time?>
                </p>
            </div>
            <div class="post-list-footer">
                <p></p>
            </div>
        </li>
        <?php } ?>
    </ul>
</div>