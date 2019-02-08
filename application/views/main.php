

<div class="main">
    <ul class="post-list-container">
        <?php foreach($postList as $post) { ?>
            <li class="post-list">

                <dl>
                    <dt class=post-list-title ><?=$post->title?></dt>
                    <dd class=post-list-subtitle ><?=$post->subtitle?></dd>
                </dl>

                <dl>
                    <dt class=post-list-title id="post-autor">글쓴이 : <?=$this->session->userdata('username')?></dt>
                    <dd class=post-list-subtitle id="post-date"><?=$post->created_time?></dd>
                </dl>

            </li>
        <?php } ?>
    </ul>
</div>

