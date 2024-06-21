<?php
    $categories = $result["data"]['categories']; 
?>


<div class="centered">

    <h1>Liste des catégories</h1>

    <div id="categoryBoard" class="board">
        <?php
        foreach($categories as $category ){  ?>

                <a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>">
                    <div class="cardTitle">
                        <h4>
                            <?= $category->getCategoryName() ?>
                        </h4>
                    </div>
                </a>
              
        
        
        
        <?php 
        } ?>
    </div>


</div>

