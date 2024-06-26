<?php
namespace Controller;

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
            var_dump("ok");
            $userManager = new UserManager();

            $userName = filter_input(INPUT_POST, "userName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $date = date('Y-m-d H:i:s'); // récupère la date actuelle
                
            if($userName && $pass1 && $pass2) {
                // var_dump("ok");die;
                $user = $userManager->findOneByUserName($userName);
                // si l'utilisateur existe
                if($user) {
                    //header("Location: index.php?ctrl=security&action=register"); exit;
                    var_dump("user déjà existant"); //TODO: ajouter un message d'erreur
                } else {
                    //insertion de l'utilisateur en BDD
                    if($pass1 == $pass2 && strlen($pass1) >= 5) { // vérification que les 2 mots de passes sont identiques, et qu'il a un minimum de caractères
                        $newUser = [
                            'userName' => $userName,
                            'password' => password_hash($pass1, PASSWORD_DEFAULT), // on stocke le mot de passe haché en BDD
                            'registrationDate' => $date
                        ];
                        
                        $userManager->add($newUser);
                            echo "<p>Merci pour votre inscription sur le forum</p>"; //TODO: ajouter un message de confirmation de de l'inscription au forum

                        header("Location: index.php?ctrl=home&action=index");
                    } else {
                        // message "Les mots de passe ne sont pas identiques ou mot de passe trop court !" //TODO: ajouter message d'"erreur
                    }
                }
            } else {
                // problème de saisie dans les champs de formulaire //TODO: ajouter message d'"erreur
            }
        
        // par défaut j'affiche le formulaire d'inscription
        //header("Location: index.php?ctrl=security&action=register"); exit;

        }
    }








    public function login () {}
    public function logout () {}
}