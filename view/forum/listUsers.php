<?php

$users = $result["data"]['users'];

?>

<h1>Liste des utilisateurs</h1>

<?php 

foreach($users as $user) { ?>

    <p class="uk-comment"><a href="#"><?= $user ?></a></p>

<?php }