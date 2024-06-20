<?php
    //$category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics</h1>

<?php 

foreach($topics as $topic ){ //var_dump($topic) ?>

    <p><a href="#"><?= $topic ?></a> par <?= $topic->getUser() ?> // <a href="#" ><?= $topic->getCategory()->getCategoryName()?></a></p>
<?php }
