<?php
    require 'config.php';
    $categories = $result["data"]['categories']; 
?>


<div class="centered blocked">

<h1>Liste des catégories</h1>

    <div id="categoryBoard" class="board">
        <?php
            foreach($categories as $category ){  ?>
                <!--Affiche toutes les catégories enregistrées dans la BDD -->
                <a class ='homeLinks' href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>">
                    <div class="cardTitle">
                        <?= $category->getCategoryName() ?>
                    </div>
                </a>
        <?php } ?>
    </div>

    


    <!--Formulaire d'ajout d'une catégorie à la BDD -->

    <?php // si l'admin est connecté
    
    if(App\Session::isAdmin()) { ?>
                                                            
        <div class='formBox'>
            <form action="index.php?ctrl=admin&action=addCategory&jeton=<?= $_SESSION['jeton']?>" method="post">

                <label for="addCategory">Ajouter une catégorie</label>
                <input required type="text" name="categoryName">
                <input name='submit' type='submit'>
            </form>
        </div>
        
    <?php } ?>

</div>

