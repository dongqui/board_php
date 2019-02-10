
<form action="/index.php/post/add" class="post-input-group"  method="POST" enctype="multipart/form-data">
    <label for="post-input-title">Title</label>
    <textarea type="text" rows="1" maxlength="255" class="post-input" id="post-input-title"  name="title" > </textarea>
    <label for="post-input-subtitle">Subtitle</label>
    <textarea type="text" rows="2" maxlength="255" class="post-input" id="post-input-subtitle"  name="subtitle" > </textarea>
    <label for="post-input-content">Content</label>
    <textarea class="post-input" id="post-input-content"  name="content" rows="4" cols="50"> </textarea>

    <button type="submit" class="btn btn-primary post-input-btn" id="post-submit-btn" type="submit" /> 제출 </button>
    <button class="btn btn-primary post-input-btn" id="post-cancel-btn " type="button" onclick="cancelHanlder()"/> 취소 </button>

</form>
<script>
    function cancelHanlder() {
        const textAreas = Array.prototype.slice.call($('textarea'));
        if (textAreas.some(textarea => textarea.value.length > 1 )) {
            if (confirm("내용이 다 날아갈건데!!!???")) {
                window.location.href = 'main'
            }
        } else {
            window.location.href = 'main'
        }
    }
</script>