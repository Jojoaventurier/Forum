<?php
  require 'config.php';
  $category = $result["data"]['category']; 
  $topics = $result["data"]['topics'];
?>

<h1><?= $category->getCategoryName() ?></h1>



<div class="centered">
<!-- Affiche tous les topics créés pour la catégorie donnée -->
  <div id="topicBoard" class="board">
    <?php 
       if (is_null($topics) == true ) {
        echo "Il n'y a pas encore de topic créé dans cette catégorie...";
    } else {
      foreach($topics as $topic ){ ?> 
            <a  href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>">
              <div class="topicCard">
                  <div class="topicTitle">
                      <h4 class='black'><?=$topic->getTitle()?></h4>
                      <p class="uk-comment">créé par <span class='bold'><?= $topic->getUser() ?></span>, le <?= $topic->getCreationDate(); ?></p>
                  </div>  
              </div>
            </a>
          
      <?php } } ?>
  </div>

  <!-- Formulaire pour ajouter un sujet sur le forum (il sera ajouté à la catégorie sur laquelle on est) -->
  <?php if (isset($_SESSION['user'])) { ?>
    <div class='formBox'>
          <form action="index.php?ctrl=forum&action=addTopic&id=<?= $category->getId()?>&jeton= <?=$_SESSION['jeton']?>" method="post">

              <h4 class='black'>Ajouter un topic</h4>
                <p class="uk-comment">
                  <label for="newTopicTitle"> Titre</label><br>
                  <input required type='text' name='newTopicTitle'>
                </p>
                <br>
                <p class="uk-text-default">
                  <label for="newTopicMessage"> Message</label><br>
                  <textarea required type="text" name="newTopicMessage" rows='10' cols='120'></textarea>
                </p><br>
              <input name='submit' type='submit'>

          </form>
      </div>
    <?php } ?>
</div>
