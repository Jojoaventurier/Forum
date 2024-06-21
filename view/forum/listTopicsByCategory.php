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
                              <p>créé par <span class='bold'><?= $topic->getUser() ?></span>, le <?= $topic->getCreationDate(); ?></p>
                              <p> Dernier message le : _______ par ________</p>
                          </div>  
                      </div>
            </a>
          
      <?php } } ?>
  </div>


  <div class='formBox'>

        <form action="index.php?ctrl=forum&action=addTopic" method="post">

            <h4>Ajouter un topic</h4>
              <p>
                <label for="newTopicTitle"> Titre</label><br>
                <input required type='text' name='newTopicTitle'>
              </p>
              <br>
              <p>
                <label for="newTopicMessage"> Message</label><br>
                <textarea required type="text" name="newTopicMessage" rows='10' cols='120'></textarea>
              </p><br>
            <input name='submit' type='submit'>

        </form>
    </div>

</div>
