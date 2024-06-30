<?php

$users = $result["data"]['users'];

?>

<h1>Liste des utilisateurs</h1>

<?php 

foreach($users as $user) { ?>

    <p class="uk-comment"></p>
    <li><a href="#"><?= $user ?></a>, inscrit depuis le <?= $user->getRegistrationDate()?></li>

<?php }