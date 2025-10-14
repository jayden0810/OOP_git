<?php
// Functie: programma login OOP 
// Auteur: Jayden Sadhoe

// Initialisatie
require_once('classes/User.php');
$user = new User();
$errors = [];

// Is de login button aangeklikt?
if (isset($_POST['login-btn'])) {

    $user->username = trim($_POST['username']);
    $user->setPassword($_POST['password'], false); // GEEN hash bij login!

    // Validatie gegevens
    $errors = $user->validateUser();

    // Indien geen fouten dan inloggen
    if (count($errors) == 0) {
        if ($user->loginUser()) {
            // Login succesvol
            header("Location: index.php");
            exit;
        } else {
            $errors[] = "Ongeldige gebruikersnaam of wachtwoord.";
        }
    }

    // Toon foutmeldingen (indien aanwezig)
    if (count($errors) > 0) {
        $message = implode("\\n", $errors);
        echo "
        <script>alert('" . $message . "')</script>
        <script>window.location = 'login_form.php'</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

    <h3>PHP - PDO Login (OOP)</h3>
    <hr/>
    
    <form action="" method="POST">    
        <h4>Login hier...</h4>
        <hr>
        
        <label>Username</label>
        <input type="text" name="username" required />
        <br>
        <label>Password</label>
        <input type="password" name="password" required />
        <br>
        <button type="submit" name="login-btn">Login</button>
        <br><br>
        <a href="register_form.php">Registreren</a>
    </form>
        
</body>
</html>
