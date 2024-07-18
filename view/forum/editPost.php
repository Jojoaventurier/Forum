<?php     
    require 'config.php';
    $post = $result["data"]['post']; ?>



<div class='centered'>
    <div class='formBox'>

            <!-- formulaire de modification d'un post déjà créé -->
            <form action="index.php?ctrl=forum&action=editPost&id=<?= $post->getId()?>" method="post">

                <h4>Modifier mon post</h4>
                <p class="uk-comment">
                    <label for="topicPost"> Message</label><br>
                    <textarea required type="text" name="topicPost" rows='10' cols='120'><?= $post->getText() ?></textarea> <!-- récupère le message original du post pour faciliter la modification -->
                </p><br>
                <input type=hidden value=<?=$_SESSION['jeton'];?> >
                <input name='submit' type='submit'>

            </form>
    </div>
</div>