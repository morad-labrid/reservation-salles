<?php
    session_start();
    include("db.php");

    if (isset($_SESSION['login'])) {
        header("Location: planning.php");
    }
////////////////////////////////////////////////////////////////
    $msg = [];
    if (isset($_POST["submit"])) {
        $user      = $_POST["username"];
        $password  = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        // Pour verifier si le username existe deja dans la base de donnée
        $existe = $conn->prepare("SELECT login FROM utilisateurs WHERE login = :user"); 
        $existe->execute(['user' => $user]);
        // $existe = $existe -> fetch(PDO::FETCH_ASSOC);
        $existe = $existe->fetch(PDO::FETCH_ASSOC);
        $existe = $existe['login'];
        // verifier si l'utilisateur a rempli tous les champs
        if (!empty($user) && !empty($password) && !empty($cpassword)) {
            // si le user est deja utiliser affichage d'un message d'erreur
            if ($existe !== $user) {
                // si les mot de passe sont identique passer a l'etape suivante
                if ($password == $cpassword) {
                    $crypt_pass = password_hash($password, PASSWORD_BCRYPT);
                    $insert = $conn -> prepare("INSERT INTO utilisateurs (login, password) VALUES (?, ?)");
                    $insert -> execute([$user, $crypt_pass]);
                    $_SESSION["login"] = $user;
                    header("Location: planning.php");
                }else array_push($msg, "Les mots de passe ne sont pas identique<br>");
            }else array_push($msg, "Le user que vous avez utiliser existe deja<br>");
        }else array_push($msg, "Merci de remplir tous les champs<br>");
    }
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../issets/css/styles.css">
    <title>INSCRIPTION | SALLE MARIAGE</title>
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
            <a href="inscription.php"><u>Inscription</u></a>
            <a href="connexion.php">Connexion</a>
        </nav>

    </header>
    <main class="form_square">
        <section>
            <form action="" method="POST">
                <div>
                    <img class="img2" src="../issets/images/wedding-ring 2.svg" alt="logo">
                    <p>INSCRIPTION</p>
                </div>
                <div class="msg_erreur">
                    <?php 
                        // pour afficher les message d'erreurs
                        foreach ($msg as $msg_erreur) {
                        echo $msg_erreur;
                        }
                    ?>
                </div>

                <label for="username"></label>
                <input type="text" name="username" id="username" placeholder="Votre username">

                <label for="password"></label>
                <input type="password" name="password" id="password" placeholder="Votre mot de passe">

                <label for="cpassword"></label>
                <input type="password" name="cpassword" id="cpassword" placeholder="Confirmer votre mot de passe">

                <input type="submit" name="submit" value="VALIDER">
            </form>
        </section>
    </main>
    <footer></footer>
</body>

</html>