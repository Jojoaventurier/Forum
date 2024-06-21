<?php
    $posts = $result["data"]['posts']; 
?>


<div class="centered">

    <h1>Liste des topics</h1>

    <div id="postsBoard" class="board">
        <?php 

        foreach($posts as $post ){ //var_dump($post) ?> 

            
            
                    <div class="postCard">
                        <div class="postText">

                            <h4>par <?= $post->getUser() ?></h4>
                            <p><?= $post->getCreationDate()?></p>
                            
                            <p> <?= $post->getText() ?></p>

                        </div>  
                    </div>
                </a>
        <?php } ?>
    </div>

</div>