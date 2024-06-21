<?php
    
    $topics = $result["data"]['topics']; 
      
?>
<div class="centered">

    <h1>Liste des topics</h1>

    <div id="topicBoard" class="board">
        <?php 

        foreach($topics as $topic ){ //var_dump($topic) ?> 

            
            <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>">
                    <div class="topicCard">
                    <div class="topicTitle">
                        <h4><?=$topic->getTitle()?></h4>
                        <p> par <?= $topic->getUser() ?> // <?= $topic->getCategory()?></p>
                    </div>  
                    </div>
                </a>
        <?php } ?>
    </div>

</div>
