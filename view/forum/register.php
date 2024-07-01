
    
<div class="centered">
    <h1>S'inscrire</h1>
    <form action="index.php?ctrl=security&action=register" method="POST">
        <label for="userName">Pseudo</label>
        <input type="text" name="userName" id="userName"><br>

        <label for="pass1">Mot de passe</label>
        <input type ="password" name="pass1" id="pass1"><br>
        <small><p>(Le mot de passe doit contenir au minimum 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial)</p></small>

        <label for="pass2">Confirmation du mot de passe</label>
        <input type="password" name="pass2" id ="pass2"><br>
        <input type="submit" name="submit" value="S'enregistrer">
    </form>
</div>
