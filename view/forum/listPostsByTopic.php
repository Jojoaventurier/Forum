<?php
    $posts = $result["data"]['posts'];
    $topic = $result["data"]['topic']; 
?>


<div class="centered">

    <div class='titleBox'>
        <p>Topic</p>
        <h1><?= $topic  ?></h1>

        <?php    
            if (isset($_SESSION['user'])) { 
                if ($topic->getUser()->getId() == $_SESSION['user']->getId()) { ?>
            <a href="index.php?ctrl=forum&action=close&id=<?= $topic->getId() ?>">Verrouiller le topic</a>
            <a href="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId() ?>">Supprimer le topic</a>
        <?php  } }   ?>

    </div> <!-- Boutons pour verrouiller / supprimer le topic -->

    <div id="postsBoard" class="board">
        <?php 

        if (is_null($posts) == true ) {
            echo "Il n'y a pas encore de messages dans ce topic...";
        } else {

                foreach($posts as $post ){  ?>
                            <!-- Affiche tous les posts du topic -->
                            <div class="postCard">
                                <div class="postText">
                                    <p class="uk-comment"><?= $post->getCreationDate()?></p>
                                    <p class="uk-comment" >Posté par <span class="uk-text-emphasis"><?= $post->getUser() ?></span></p>

                                    <div class='textBox'>
                                        <p class="uk-text-emphasis"> <?= $post->getText() ?><p>
                                    </div> <!-- Boutons pour modifier/supprimer le post -->
                            <?php    
                            if (isset($_SESSION['user'])) {

                                if ($post->getUser()->getId() == $_SESSION['user']->getId()) { ?>
                                    <a href="index.php?ctrl=forum&action=deletePost&id=<?= $post->getId() ?>">Supprimer le post</a>
                                    <a href="index.php?ctrl=forum&action=displayPostEdit&id=<?= $post->getId() ?>">Modifier le post</a>
                            <?php  }

                            }

                            ?>
                                
                                </div>  
                            </div>
                        </a>
                <?php } 
        } ?>
    </div>


    <!--Formulaire pour ajouter un post au topic -->
    <?php if (isset($_SESSION['user']) || $_SESSION['user']->getRole ) { ?>
        <div class='formBox'>
            <form action="index.php?ctrl=forum&action=addPost&id=<?= $topic->getId() ?>" method="post">
                <p class="uk-text-emphasis">Répondre</p>
                <p class="uk-comment">
                    <label for="topicPost"> Message</label><br>
                    <textarea required type="text" name="topicPost" rows='10' cols='120'></textarea>
                </p><br>
                <input name='submit' type='submit'>
            </form>
        </div>
    <?php } ?>

</div>