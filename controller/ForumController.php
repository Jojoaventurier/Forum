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

    public function index() {
        
        // créer une nouvelle instance de CategoryManager
        $categoryManager = new CategoryManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $categoryManager->findAll(["categoryName", "DESC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => [
                "categories" => $categories,
            
            ]
        ];
    }

    public function listTopics() {

        $topicManager = new TopicManager();
;       $topics = $topicManager->findAll(["creationdate", "DESC"]);

        
        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Liste de tous les topics du forum",
            "data" => [ 
                "topics" => $topics
            ]
        ];       
    }

    public function listTopicsByCategory($id) {

        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        $postManager = new PostManager();
        
        $category = $categoryManager->findOneById($id);
        $topics = $topicManager->findTopicsByCategory($id);

        return [
            "view" => VIEW_DIR."forum/listTopicsByCategory.php",
            "meta_description" => "Liste des topics par catégorie : ".$category,
            "data" => [
                "category" => $category,
                "topics" => $topics
            ]
        ];
    }

    public function listPostsByTopic($id) {

        $topicManager = new TopicManager();
        $postManager = new PostManager();
        $topic = $topicManager->findOneById($id);
        $posts = $postManager->findPostsByTopic($id);

        return [
            "view" => VIEW_DIR."forum/listPostsByTopic.php",
            "meta_description" => "Messages postés sur le topic : ".$topic,
            "data" => [
                "topic" => $topic,
                "posts" => $posts
            ]
        ];
    }


    public function listUsers() {

        $userManager = new UserManager();

        $users = $userManager->findAll(["registrationDate", "DESC"]);

        return [
            "view" => VIEW_DIR."forum/listUsers.php",
            "meta_description" => "Liste de tous les utilisateurs du forum",
            "data" => [ 
                "users" => $users
            ]
        ];
    }



    public function addCategory() {

        $categoryManager = new CategoryManager;
        var_dump($_POST);

        $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        var_dump($categoryName);

        if (isset($_POST["submit"]) && strlen($categoryName) != 0) {

            $category = [ 'categoryName' => $categoryName];

            return $categoryManager->add($category);  
        }
    }
}