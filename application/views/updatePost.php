<form action="/index.php/post/update/<?=$post->PK_POST_ID?>" method="POST" enctype="multipart/form-data">
    제목: <input type="text" name="title" value="<?=$post->title?>" />
    설명: <input type="text" name="description" value="<?=$post->description?>"/>
    내용: <input type="text" name="content" value="<?=$post->content?>"/>
    <input type="submit" />
</form>