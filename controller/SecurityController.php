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

            $userName = filter_input(INPUT_POST, "userName", FILTER_SANITIZE_FULL_SPECIAL_CHARS); // filtre et sanitise les valeurs entrées par l'utilisateur dans le formulaire (XSS)
            $pass1 = filter_input(INPUT_POST, "pass1", FILTER_VALIDATE_REGEXP,
            array(
                "options" => array("regexp"=>'^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$^') // impose au minimum 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial
            ) );


            $pass2 = filter_input(INPUT_POST, "pass2", FILTER_VALIDATE_REGEXP,
            array(
                "options" => array("regexp"=>'^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$^')
            ) );

            $date = date('Y-m-d H:i:s'); // récupère la date actuelle
                
            if($userName && $pass1 && $pass2) {
                
                $user = $userManager->findOneByUserName($userName); // cherche si un utilisateur existe déjà avec ce nom d'utilisateur

                // si l'utilisateur existe
                if($user) {
                    Session::addFlash("error", "Ce nom d'utilisateur existe déjà !");
                } else {
                    //insertion de l'utilisateur en BDD
                    if($pass1 === $pass2 && strlen($pass1) >= 5) {       // vérification que les 2 mots de passes sont identiques, et qu'il a un minimum de caractères
                        $newUser = [
                            'userName' => $userName,                // on attribue le username saisi par l'utilisateur 
                            'password' => password_hash($pass1, PASSWORD_DEFAULT),          // on stocke le mot de passe haché en BDD
                            'registrationDate' => $date,             // on attribue la date actuelle au champs registrationDate
                            'roles' => json_encode(['ROLE_USER'])     // on attribue un rôle de base à tout utilisateur qui s'inscrit
                        ];
                        
                        $userManager->add($newUser);

                        Session::addFlash("success", "Inscription réussie, connectez-vous !");
                        $this->redirectTo("security", "loginForm");

                        } else {
                            Session::addFlash("error", "Le mot de passe est invalide.");
                        }
                    }

                } else {
                    Session::addFlash("error", "Vous n'avez pas rempli tous les champs ou le mot de passe est invalide !");
                }
            }
            return [
                "view" => VIEW_DIR."forum/register.php",
                "meta_description" => "Page d'inscription au forum"
            ];
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

            unset($_SESSION['jeton']); // protection csrf
            
            $userManager = new UserManager();

            $userName = filter_input(INPUT_POST, "userName",FILTER_SANITIZE_FULL_SPECIAL_CHARS);         // filtre pour lutter contre la faille XSS
            $password = filter_input(INPUT_POST, "password", FILTER_VALIDATE_REGEXP,
                                        array(
                                            "options" => array("regexp"=>'^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$^') // impose au minimum 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial
                                        ) );

            if($userName && $password) {

                $user = $userManager->findOneByUserName($userName); //on récupère les données de l'utilisateur que l'on stocke dans une variable $user
                
                if($user) {                         // on vérifie qu'on a bien un user qui existe dans la BDD
                    $hash = $user->getPassword();          // on récupère le mot de passe haché de la BDD (accessible depuis la variable $user)

                    if(password_verify($password, $hash)) {         // on vérifie vérifie que les empreintes numériques correspondent

                        $_SESSION["user"] = $user;                  // si les mdp correspondent, on met $user en session à l'aide de la superglobale $_SESSION
                        Session::addFlash("success", "Vous êtes connectés, bienvenue !");
                        $this->redirectTo("home"); // on redirige l'utilisateur sur la page d'accueil
                    } else {
                       Session::addFlash("error", "Le mot de passe est faux !");  
                    } 
                 } 
               
            } else {
                Session::addFlash("error", "Vous n'avez pas rempli tous les champs !");
            }
        }
        return [
            "view" => VIEW_DIR."forum/login.php",
            "meta_description" => "Page de connection"
        ];
    }
  

    public function logout () {
        unset($_SESSION["user"]); // on enlève l'utilisateur enregistré dans la session
        Session::addFlash("success", "Session déconnectée !"); // message de déconnection réussie
        $this->redirectTo("home"); // redirection vers la page d'accueil
    }
}