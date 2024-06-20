<?php
  $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics de la catégorie <?= $category->getCategoryName() ?></h1>

<?php 

foreach($topics as $topic ){ ?> 

    <p><a href="#"><?=$topic->getTitle()?></a></p>
    
<?php }
