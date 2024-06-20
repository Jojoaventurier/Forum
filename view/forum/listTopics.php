<?php
    
    $topics = $result["data"]['topics']; 
      
?>
<div class="centered">

    <h1>Liste des topics</h1>

    <div id="topicBoard" class="board">
        <?php 

        foreach($topics as $topic ){ //var_dump($topic) ?> 

            <p><a href="#"><?= $topic ?></a> par <?= $topic->getUser() ?> // <a href="#" ><?= $topic->getCategory()->getCategoryName()?></a></p>
            <a href="#">
                    <div class="topicCard">
                    <div class="topicTitle">
                        <h4><?=$topic->getTitle()?></h4>
                    </div>  
                    </div>
                </a>
        <?php } ?>
    </div>

</div>
