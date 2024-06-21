<?php
  $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1><?= $category->getCategoryName() ?></h1>


<div class="centered">

  <div id="topicBoard" class="board">
    <?php 

    foreach($topics as $topic ){ ?> 
          <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>">
            <div class="topicCard">
              <div class="topicTitle">
                <h4><?=$topic->getTitle()?></h4>
                <p class = "redigepPar"> créé par <?= $topic->getUser() ?> le <?= $topic->getCreationDate() ?></p>
              </div>  
            </div>
          </a>
        
    <?php } ?>
  </div>

  </div>
