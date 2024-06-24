<?php     
    $post = $result["data"]['post']; ?>



<div class='centered'>
    <div class='formBox'>

            <form action="index.php?ctrl=forum&action=editPost&id=<?= $post->getId() ?>" method="post">

                <h4>Modifier mon post</h4>
                <p class="uk-comment">
                    <label for="topicPost"> Message</label><br>
                    <textarea required type="text" name="topicPost" rows='10' cols='120'><?= $post->getText() ?></textarea>
                </p><br>
                <input name='submit' type='submit'>

            </form>
    </div>
</div>