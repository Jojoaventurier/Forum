<?php
    $categories = $result["data"]['categories']; 
?>


<div class="centered">

    <h1>Liste des catégories</h1>

    <div class="categoryBoard">
        <?php
        foreach($categories as $category ){  ?>


            <div class="categoryCard">
                <h3><a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>"><?= $category->getCategoryName() ?></a></h3>
            </div>
        
        
        
        <?php 
        } ?>
    </div>


</div>

