<?php
    $categories = $result["data"]['topics']; 
?>

<h1>Liste des topics</h1>

<?php 

foreach($categories as $tcategory ){ //var_dump($topic) ?> 

    <p><a href="#"><?= $category ?></a> <a href="#" ><?= $category?></a></p>
<?php }
