<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?= $meta_description ?>">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.20.4/css/uikit-core-rtl.min.css" integrity="sha512-/KGfVFsbk9a7nzjCYF0dSMc+H58wKeODeZVyPaR20TlLVtoQVitubbROxToRODDiBW4EbBSAA//yAt1N+xgVtg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.css">
        <title>Le forum des étudiants d'élan</title>
    </head>
    <body>
        <div id="wrapper"> 
            <div id="mainpage">
                <header>
                        <nav>
                            <div id="nav">
                                <ul class='navigation'>
                                    <li><a class="nav-link marginLeft" href="index.php?ctrl=home&action=index"></i>Accueil</a></li>
                                
                                    <?php // si l'admin est connecté
                                    if(App\Session::isAdmin()){
                                        ?>
                                        <li><a href="index.php?ctrl=admin&action=listUsers">Voir la liste des utilisateurs</a></li>
                                        <?php } 

                                    // si l'utilisateur est connecté 
                                    if(App\Session::getUser()){
                                        ?> 
                                        <li></span>&nbsp;<?= App\Session::getUser()?></li>
                                        <li><a class="nav-link" href="index.php?ctrl=security&action=logout">Déconnexion</a></li>
                                            
                                            <?php
                                    }
                                    else{
                                        ?>
                                            <li><a class="nav-link" href="index.php?ctrl=security&action=loginForm">Connexion</a></li>
                                            <li><a class="nav-link" href="index.php?ctrl=security&action=registerForm">Inscription</a></li>
                                    </ul>
                                    <?php    } ?>
                            </div>
                        </nav>
                </header>

                <main id="forum">
                      <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
                    <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
                    <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>

                    <?= $page ?>
                    
                </main>
            </div>
            <footer>
                <p>&copy; <?= date_create("now")->format("Y") ?> - <a href="#">Règlement du forum</a> - <a href="#">Mentions légales</a></p>
            </footer>
        </div>
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
        </script>
        <script>
            $(document).ready(function(){
                $(".message").each(function(){
                    if($(this).text().length > 0){
                        $(this).slideDown(500, function(){
                            $(this).delay(3000).slideUp(500)
                        })
                    }
                })
                $(".delete-btn").on("click", function(){
                    return confirm("Etes-vous sûr de vouloir supprimer?")
                })
                tinymce.init({
                    selector: '.post',
                    menubar: false,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table paste code help wordcount'
                    ],
                    toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                    content_css: '//www.tiny.cloud/css/codepen.min.css'
                });
            })
        </script>
        <script src="<?= PUBLIC_DIR ?>/js/script.js"></script>
    </body>
</html>