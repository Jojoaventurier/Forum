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
        $categories = $categoryManager->findAll(["id_category", "ASC"]);

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
;       $topics = $topicManager->findAll(["creationDate", "DESC"]);

        
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

        $categoryManager = new CategoryManager();

        $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (isset($_POST["submit"]) && strlen($categoryName) != 0) {

            $category = [ 'categoryName' => $categoryName];

            $categoryManager->add($category);  

            $this->redirectTo("forum", "index");
        }
    }

    public function addTopic($id) {

        $topicManager = new TopicManager();
        $postManager = new PostManager();
        
        $user = 1;
        $id = $_GET['id'];
        
        $newTopicTitle = filter_input(INPUT_POST, 'newTopicTitle', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $newTopicPost = filter_input(INPUT_POST, 'newTopicMessage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $date = date('Y-m-d H:i:s');

        if (isset($_POST["submit"])) {


            $newTopic = [
                'title' => $newTopicTitle,
                'user_id' => $user,
                'category_id' => $id,
                'creationDate' => $date
            ];

            $last_id = $topicManager->add($newTopic);

            $newPost = [
                'text' => $newTopicPost,
                'user_id' => $user,
                'topic_id' => $last_id, 
                'creationDate' => $date
            ];
            $postManager->add($newPost);

            $this->redirectTo("forum", 'index');
        }
    }

    public function addPost($id) {

        $postManager = new PostManager();

        $id = $_GET['id'];
        $text = filter_input(INPUT_POST, 'topicPost', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $date = $date = date('Y-m-d H:i:s');
        $user = 1;

    
        $newPost = [
            'text' => $text,
            'user_id' => $user,
            'topic_id' => $id,
            'creationDate' => $date
        ];

        $postManager->add($newPost);

        $this->redirectTo("forum", 'index');
    }


    public function deletePost($id) {

        $postManager = new PostManager();

        $id = $_GET['id'];

        $postManager->delete($id);

        $this->redirectTo("forum", 'index');
    }

    public function deleteTopic($id) {

        $topicManager = new TopicManager();

        $id = $_GET['id'];

        $topicManager->delete($id);

        $this->redirectTo("forum", 'index');
    }


}