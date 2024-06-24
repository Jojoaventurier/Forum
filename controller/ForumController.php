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
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par id)
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
        // créé une nouvelle instance de TopicManager
        $topicManager = new TopicManager();
        // récupère la liste de tous les topics (triés par date de création)
;       $topics = $topicManager->findAll(["creationDate", "DESC"]);

        // le controller communique avec la vue "listTopics" (view) pour lui envoyer la liste des topics (data)
        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Liste de tous les topics du forum",
            "data" => [ 
                "topics" => $topics
            ]
        ];       
    }


    public function listTopicsByCategory($id) {

        // créé une nouvelle instance de TopicManager et CategoryManager
        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        
        $category = $categoryManager->findOneById($id); // récupère la catégorie via son id
        $topics = $topicManager->findTopicsByCategory($id); // récupère tous les topics à partir de l'id de la catégorie

        // le controller communique avec la vue "listTopicsByCategory" (view) pour lui envoyer la liste des topics (data)
        return [
            "view" => VIEW_DIR."forum/listTopicsByCategory.php",
            "meta_description" => "Liste des topics par catégorie : ".$category,
            "data" => [
                "category" => $category,
                "topics" => $topics,
            ]
        ];
    }


    public function listPostsByTopic($id) {

        // créé une nouvelle instance de TopicManager et PostManager
        $topicManager = new TopicManager();
        $postManager = new PostManager();

        $topic = $topicManager->findOneById($id); // récupère le topic via son id
        $posts = $postManager->findPostsByTopic($id); // récupère tous les posts du topic via l'id de la catégorie, fait appel à la méthode findpostsByTopic() du PostManager

        // le controller communique avec la vue "listPostsByTopic" (view) pour lui envoyer la liste des posts (data)
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


    // permet d'ajouter une catégorie à la BDD
    public function addCategory() {
       
        $categoryManager = new CategoryManager();

        $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // récupère et sanitise les valeurs de champs entrées par l'utilisateur

        if (isset($_POST["submit"]) && strlen($categoryName) != 0) { // vérifie que l'utilisateur a entré quelque chose

            $category = [ 'categoryName' => $categoryName];

            $categoryManager->add($category);  

            $this->redirectTo("forum", "index");
        }
    }

    // permet d'ajouter un topic à une catégorie, avec création d'un premier post obligatoire
    public function addTopic($id) {

        $topicManager = new TopicManager();
        $postManager = new PostManager();
        
        $user = 1;
        $id = $_GET['id'];
        
        $newTopicTitle = filter_input(INPUT_POST, 'newTopicTitle', FILTER_SANITIZE_FULL_SPECIAL_CHARS);  // récupère et sanitise le titre entré par l'utilisateur
        $newTopicPost = filter_input(INPUT_POST, 'newTopicMessage', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // récupère et sanitise le texte entré par l'utilisateur

        $date = date('Y-m-d H:i:s'); // récupère la date de création du topic
        var_dump($_POST);
        if (isset($_POST["submit"])) {

            // stockage des informations du topic dans un objet newTopic
            $newTopic = [
                'title' => $newTopicTitle,
                'user_id' => $user,
                'category_id' => $id,
                'creationDate' => $date
            ];

            $last_id = $topicManager->add($newTopic); // fonction add retourne automatiquement le lastInsertedId() en même temps qu'elle effectue l'inserstion dans la BDD (voir Manager)

            // stockage des informations du post dans un objet newPost
            $newPost = [
                'text' => $newTopicPost,
                'user_id' => $user,
                'topic_id' => $last_id, 
                'creationDate' => $date
            ];
            $postManager->add($newPost); // insertion du nouveau post à la BDD

            $this->redirectTo("forum", 'index');
        }
    }

    // ajout d'un post à un topic (post lié au topic par l'id du topic)
    public function addPost($id) {

        $postManager = new PostManager();

        $id = $_GET['id']; // récupération de l'id du topic où on ajoute un message
        $text = filter_input(INPUT_POST, 'topicPost', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // récupère et sanitise le texte entré par l'utilisateur
        $date = $date = date('Y-m-d H:i:s'); // récupère la date de création du post
        $user = 1;

        // stockage des informations dans un objet Post
        $newPost = [
            'text' => $text,
            'user_id' => $user,
            'topic_id' => $id,
            'creationDate' => $date
        ];

        $postManager->add($newPost); // ajout de l'objet post créé à la BDD

        $this->redirectTo("forum", 'index');
    }

    // fonction de suppression d'un post (se base sur l'id du post)
    public function deletePost($id) {

        $postManager = new PostManager();

        $id = $_GET['id'];

        $postManager->delete($id);

        $this->redirectTo("forum", 'index');
    }

    // fonction de suppression d'un topic (se base sur l'id du topic)
    public function deleteTopic($id) {

        $topicManager = new TopicManager();

        $id = $_GET['id'];

        $topicManager->delete($id);

        $this->redirectTo("forum", 'index');
    }

    //fonction qui affiche le formulaire de modification d'un post
    public function displayPostEdit($id) {

        $postManager = new PostManager();
        $id = $_GET['id'];
        $post = $postManager->findOneById($id);

        return [
            "view" => VIEW_DIR."forum/editPost.php",
            "meta_description" => "Modifier le message : ",
            "data" => [
                "post" => $post
            ]
        ];

    }

    // fonction qui modifie le poste et insère le nouveau champs 'text' à la BDD (le post garde son id)
    public function editPost($id) {

        $postManager = new PostManager();

        $id = $_GET['id'];

        $text = filter_input(INPUT_POST, 'topicPost', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $postManager->update($id, $text);

        $this->redirectTo("forum", 'index');

    }


}