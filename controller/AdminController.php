<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\CategoryManager;


class AdminController extends AbstractController implements ControllerInterface{

    // permet d'afficher de tous les utilisateurs enregistrés sur le forum
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
    
            if (isset($_POST["submit"]) && strlen($categoryName) != 0 && isset($_GET['jeton']) && 
            ($_GET['jeton'] == $_SESSION['jeton']))  { // vérifie que l'utilisateur a entré quelque chose et protection contre la csrf

    
                $category = [ 'categoryName' => $categoryName];
    
                $categoryManager->add($category);  
    
                $this->redirectTo("forum", "index");
            }
        }

}