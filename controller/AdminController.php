<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\UserManager;


class ForumController extends AbstractController implements ControllerInterface{

    public function listUsers() {
        // créé une nouvelle instance de UserManager
        $userManager = new UserManager();

        $users = $userManager->findAll(["registrationDate", "DESC"]); // récupère tous les utilisateurs enregistrés

        // le controller communique avec la vue "listUsers" pour lui envoyer la liste des utilisateurs (data)
        return [
            "view" => VIEW_DIR."forum/listUsers.php",
            "meta_description" => "Liste de tous les utilisateurs du forum",
            "data" => [ 
                "users" => $users
            ]
        ];
    }

}