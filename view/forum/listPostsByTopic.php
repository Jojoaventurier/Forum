<?php
    $posts = $result["data"]['posts'];
    $topic = $result["data"]['topic']; 
?>


<div class="centered">

    <div class='titleBox'>
        <p>Topic</p>
        <h1><?= $topic  ?></h1>
    </div>

    <div id="postsBoard" class="board">
        <?php 

        if (is_null($posts) == true ) {
            echo "Il n'y a pas encore de messages dans ce topic...";
        } else {

                foreach($posts as $post ){  ?>

                            <div class="postCard">
                                <div class="postText">
                                    <p><?= $post->getCreationDate()?></p>
                                    <h4><span class='normal'>Posté par</span> <?= $post->getUser() ?></h4>
                                    

                                    <div class='textBox'>
                                        <p> <?= $post->getText() ?><p>
                                    </div>

                                </div>  
                            </div>
                        </a>
                <?php } 
        } ?>
    </div>

    <div class='formBox'>

        <form action="index.php?ctrl=forum&action=addMessage&id=" method="post">

            <h4>Répondre</h4>
              <p>
                <label for="addTopicMessage"> Message</label><br>
                <textarea required type="text" name="topicMessage" rows='10' cols='120'></textarea>
              </p><br>
            <input name='submit' type='submit'>

        </form>
    </div>

</div>