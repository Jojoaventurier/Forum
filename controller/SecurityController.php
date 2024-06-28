<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function registerForm () {
          
        // on renvoie simplement la vue du formulaire d'inscription
        return [
            "view" => VIEW_DIR."forum/register.php",
            "meta_description" => "Formulaire d'inscription sur le forum",
            "data" => []
        ];
    }


    public function register() {

        if (isset($_POST["submit"])) {
            
            $userManager = new UserManager();

            $userName = filter_input(INPUT_POST, "userName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $date = date('Y-m-d H:i:s'); // récupère la date actuelle
                
            if($userName && $pass1 && $pass2) {
                
                $user = $userManager->findOneByUserName($userName);

                // si l'utilisateur existe
                if($user) {
                    echo "<p>Nom d'utilisateur déjà existant</p>"; //TODO: ajouter un message d'erreur
                    header("Location: index.php?ctrl=security&action=registerForm"); exit;
                } else {
                    //insertion de l'utilisateur en BDD
                    if($pass1 == $pass2 && strlen($pass1) >= 5) {       // vérification que les 2 mots de passes sont identiques, et qu'il a un minimum de caractères
                        $newUser = [
                            'userName' => $userName,                // on attribue le username saisi par l'utilisateur 
                            'password' => password_hash($pass1, PASSWORD_DEFAULT),          // on stocke le mot de passe haché en BDD
                            'registrationDate' => $date,             // on attribue la date actuelle au champs registrationDate
                            'role' => json_encode(['ROLE_USER'])     // on attribue un rôle de base à tout utilisateur qui s'inscrit
                        ];
                        
                        $userManager->add($newUser);

                        echo "<p>Merci pour votre inscription sur le forum</p>"; //TODO: ajouter un message de confirmation de de l'inscription au forum
                        header("Location: index.php?ctrl=home&action=index");

                    } else {

                        echo "<p>Les mots de passe ne sont pas identiques ou mot de passe trop court !</p>"; //TODO: ajouter message d'"erreur
                    }
                }
            } else {
                // problème de saisie dans les champs de formulaire //TODO: ajouter message d'"erreur
            }
        }
    }

    public function loginForm() {
        return [
            "view" => VIEW_DIR."forum/login.php",
            "meta_description" => "Formulaire de connexion au forum",
            "data" => []
        ];
    }

    public function login () {

        if($_POST["submit"]) {      // si le formulaire est soumis

            $userManager = new UserManager();

            $userName = filter_input(INPUT_POST, "userName",FILTER_SANITIZE_FULL_SPECIAL_CHARS);         // filtre pour lutter contre la faille XSS
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($userName && $password) {

                $user = $userManager->findOneByUserName($userName); //on récupère les données de l'utilisateur que l'on stocke dans une variable $user
                
                if($user) {                         // on vérifie qu'on a bien un user qui existe dans la BDD
                    $hash = $user->getPassword();          // on récupère le mot de passe haché de la BDD (accessible depuis la variable $user)

                    if(password_verify($password, $hash)) {         // on vérifie vérifie que les empreintes numériques correspondent

                        $_SESSION["user"] = $user;                  // si les mdp correspondent, on met $user en session à l'aide de la superglobale $_SESSION
                        
                        header("Location: index.php?ctrl=home&action=index"); //exit;         // on redirige l'utilisateur sur la page d'accueil
                    } else {
                       // header("Location: index.php?ctrl=security&action=loginForm"); //exit;
                        // message utilisateur inconnu ou mot de passe incorrect   
                    } 
                 } else {
                  //  header("Location: index.php?ctrl=security&action=loginForm"); //exit;
                    // message utilisateur inconnu ou mot de passe incorrect
                }
            }
        }
    }
  

    public function logout () {
        unset($_SESSION["user"]);
        header("Location: index.php?ctrl=home&action=index"); exit;
    }
}