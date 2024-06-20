<?php
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics par catégories</h1>

<?php 
    var_dump($topics);
foreach($topics as $topic ){ //var_dump($topic) ?> 
    <h2><a href="#"><?= $topic->getCategory() ?></a></h2>
    <p> <a href="#" ><?= $topic->listTopicsByCategory($topic->getCategory()->getId()) ?></a></p>
<?php }
