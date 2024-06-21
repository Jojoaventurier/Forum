<?php
    $posts = $result["data"]['posts'];
    $topic = $result["data"]['topic']; 
?>


<div class="centered">

    <h1><?= $topic  ?></h1>

    <div id="postsBoard" class="board">
        <?php 

        foreach($posts as $post ){ //var_dump($post) ?> 

            
            
                    <div class="postCard">
                        <div class="postText">
                            <p><?= $post->getCreationDate()?></p>
                            <h4>Posté par <?= $post->getUser() ?></h4>
                            

                            <div class='textBox'>
                                <p> <?= $post->getText() ?><p>
                            </div>

                        </div>  
                    </div>
                </a>
        <?php } ?>
    </div>

</div>