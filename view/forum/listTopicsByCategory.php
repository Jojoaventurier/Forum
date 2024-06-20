<?php
  $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics de la catégorie <?= $category->getCategoryName() ?></h1>


<div class="centered">

  <div id="topicBoard" class="board">
    <?php 

    foreach($topics as $topic ){ ?> 
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
