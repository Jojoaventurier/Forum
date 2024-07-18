<?php


    if (!isset($_SESSION['jeton'])) {
        $_SESSION['jeton'] = bin2hex(openssl_random_pseudo_bytes(6));
     }