<?php

    session_start();
    include("db.php");
    if (isset($_SESSION['login'])) {
        header("Location: planning.php");
    }
    ////////////////////////////////////////////////////////////////
    // crée un tableau pour stocker les messages d'erreur
    $msg = [];
    if (isset($_POST["submit"])) {
        $user     = $_POST["username"];
        $password = $_POST["password"];
        // decrypter le mot de passe
        $info = $conn->prepare(" SELECT login, password FROM utilisateurs WHERE login = :user ");
        $info->execute(['user' => $user]);
        $info    = $info -> fetchObject();
        if ($info != null) {
            $crypted = $info->password;
            $login   = $info->login;
            // si le mdp crypter est == le mdp entrer cela est = 1 sinon = 0
            $decrypted = password_verify($password, $crypted);
        }
        
        
        // verifeir si tous les champs son remplis
        if (!empty(trim($user)) && !empty(trim($password))) {
            // si le user et le mot de passe entrer sont correct creation d'une session
            if ($login === $user && $decrypted == true) {
                $_SESSION['login'] = $user;
                $_SESSION['password'] = $password;
                header("Location: planning.php");
            } else array_push($msg, "le username ou le mot de passe n'est pas correct ");
        } else array_push($msg, "Merci de remplir tous les champs");
    }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../issets/css/styles.css">
    <title>CONNEXION | SALLE MARIAGE</title>
</head>

<body>
    <header class="m_header">

        <nav>
            <a href="../index.php">Accueil</a>
            <a href="Planning.php">Planning</a>
            <div>
                <img class="img1" src="../issets/images/wedding-ring.svg" alt="logo">
                <img class="img2" src="../issets/images/wedding-ring 2.svg" alt="logo">
            </div>
            <a href="inscription.php">Inscription</a>
            <a href="connexion.php"><u>Connexion</u></a>
        </nav>

    </header>
    <main class="form_square">
        <section>
            <form action="" method="POST">
                <div class="top_form">
                    <img class="img2" src="../issets/images/wedding-ring 2.svg" alt="logo">
                    <p>CONNEXION</p>
                </div>
                <div class="msg_erreur">
                    <?php  
                        // pour afficher les message d'erreurs
                        foreach ($msg as $msg_erreur) {
                        echo "<p>$msg_erreur<p>";
                        } 
                    ?>
                </div>
                
                <label for="username"></label>
                <input type="text" name="username" id="username" placeholder="Votre username">

                <label for="password"></label>
                <input type="password" name="password" id="password" placeholder="Votre mot de passe">

                <input type="submit" name="submit" value="VALIDER">
            </form>
        </section>
    </main>
    <footer></footer>
</body>

</html>