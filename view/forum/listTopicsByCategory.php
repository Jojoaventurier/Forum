<?php
  $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics de la catégorie<br> <span><?= $category->getCategoryName() ?></span></h1>


<div class="centered">

  <div id="topicBoard" class="board">
    <?php 

    foreach($topics as $topic ){ ?> 
          <a href="#">
            <div class="topicCard">
              <div class="topicTitle">
                <h4><?=$topic->getTitle()?></h4>
                <p class = "redigepPar">par <?= $topic->getUser() ?></p>
              </div>  
            </div>
          </a>
        
    <?php } ?>
  </div>

  </div>
