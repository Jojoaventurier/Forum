<?php
    $categories = $result["data"]['categories']; 
?>


<div class="centered">

    <h1>Liste des catégories</h1>

    <div id="categoryBoard" class="board">
        <?php
            foreach($categories as $category ){  ?>

                    <a class ='homelinks' href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>">
                        <div class="cardTitle">
                            <h4 class="uk-comment">
                                <?= $category->getCategoryName() ?>
                            </h4>
                        </div>
                    </a>
        <?php } ?>
    </div>

    <div class='formBox'>

        <form action="index.php?ctrl=forum&action=addCategory" method="post">

            <label for="addCategory">Ajouter une catégorie</label>
            <input required type="text" name="categoryName">
            <input name='submit' type='submit'>

        </form>
    </div>


</div>

