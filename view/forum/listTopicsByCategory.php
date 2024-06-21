<?php
  $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1><?= $category->getCategoryName() ?></h1>


<div class="centered">

  <div id="topicBoard" class="board">
    <?php 
       if (is_null($topics) == true ) {
        echo "Il n'y a pas encore de topic créé dans cette catégorie...";
    } else {
      foreach($topics as $topic ){ ?> 
            <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>">
                      <div class="topicCard">
                          <div class="topicTitle">
                              <h4><?=$topic->getTitle()?></h4>
                              <p>créé par <?= $topic->getUser() ?>, le <?= $topic->getCreationDate(); // <?= $topic->getCategory()?></p>
                              <p> Dernier message le : _______ par ________</p>
                          </div>  
                      </div>
            </a>
          
      <?php } } ?>
  </div>

  </div>
