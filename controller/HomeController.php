<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\TopicManager;

class HomeController extends AbstractController implements ControllerInterface {

    // fonction index appelée par défaut si le controlleur ne trouve pas d'action existante, renvoie à la page d'accueil
    public function index(){

        $topicManager = new TopicManager(); // création d'une instance TopicManager
        $topics = $topicManager->findAll(["creationDate", "DESC"]); // récupération de tous les sujets, ordonnés par date de création du plus récent au plus vieux

        return [
            "view" => VIEW_DIR."home.php",  // récupération de la vue 'home'
            "meta_description" => "Page d'accueil du forum", // meta description de la page renvoyée
            "data" => [
                "topics" => $topics // envoi des sujets récupérés via le tableau data qui sera récupéré et utilisé sur la page home.php
            ]
        ];
    }
        
    public function users(){
        $this->restrictTo("ROLE_USER");

        $manager = new UserManager();
        $users = $manager->findAll(['register_date', 'DESC']);

        return [
            "view" => VIEW_DIR."security/users.php",
            "meta_description" => "Liste des utilisateurs du forum",
            "data" => [ 
                "users" => $users 
            ]
        ];
    }
}
