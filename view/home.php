<!-- <a href="index.php?ctrl=security&action=login">Se connecter</a> -->
<!-- <a href="index.php?ctrl=security&action=register">S'inscrire</a> -->
<?php
    $topics = $result["data"]['topics'];    
?>

    <h1>FORUM DES ETUDIANTS</h1>

<div id="homelinksContainer" class="centered home flex">

    <div class='paragraph'>
        <p class="justified">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ut nemo quia voluptas numquam, itaque ipsa soluta ratione eum temporibus aliquid, facere rerum in laborum debitis labore aliquam ullam cumque.</p>
    </div>

    <div class='linksContainer'>
        <a class ='homelinks' href="index.php?ctrl=forum&action=listTopicsByCategories">
            <div class='cardTitle'>
                Liste des catégories
            </div>
        </a>
        <a class ='homelinks' href="index.php?ctrl=forum&action=listTopics">
            <div class='cardTitle'>
                Liste des topics
            </div>
        </a>
    </div>
</div>

<div class="centered">

    <h3 class='no-margin'>Derniers topics ajoutés</h3>

    <div id="topicBoard" class="board">
        <?php  // affichage des derniers topics enregistrés sur le forum (affichage du plus récent au plus vieux)

        foreach($topics as $topic ){ ?> 

            <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>">
                <div class="topicCard">
                    <h4 class='black'><?=$topic->getTitle()?></h4>
                    <p class="uk-comment">créé par <span class='bold'><?= $topic->getUser() ?></span>, le <?= $topic->getCreationDate(); // <?= $topic->getCategory()?></p>
                </div>
            </a>

        <?php } ?>
    </div>
</div>


   