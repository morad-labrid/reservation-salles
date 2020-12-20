<?php

    session_start();
    include("db.php");
    if (!isset($_SESSION['login'])) {
        header("Location: connexion.php");
    }
    $session      = $_SESSION['login'];
    $session_pass = $_SESSION['password'];
    $msg = [];
    if (isset($_POST['s_n_u'])) {
        $new_user = $_POST["new_user"];
        $password = $_POST["password"];
        // Pour verifier si le username existe deja dans la base de donnée
        $existe = $conn->prepare("SELECT login FROM utilisateurs WHERE login = :user"); 
        $existe->execute(['user' => $new_user]);
        $existe = $existe->fetch(PDO::FETCH_ASSOC);
        if ($existe == false) {
            if ($session_pass == $password) {
                $update = $conn->prepare("UPDATE utilisateurs SET login = :new_user WHERE login = '$session'"); 
                $update->execute(['new_user' => $new_user]);
                $msg = "vous avez bien modifier votre username";
            }else $msg = "Le mot de passe n'est pas correcte";
        }else $msg = "le username que vous avez saisi existe deja";
    }

    if (isset($_POST['s_n_p'])) {
        $password      = $_POST["password"];
        $new_password  = $_POST["new_password"];
        $cNew_password = $_POST["cNaw_password"];

        if ($session_pass == $password) {
            if ($new_password == $cNew_password) {
                $crypt_pass = password_hash($new_password, PASSWORD_BCRYPT);
                $update = $conn->prepare("UPDATE utilisateurs SET password = :new_user WHERE login = '$session'");
                $update->execute(['new_user' => $crypt_pass]);
                $msg = "Vous avez bien modifier votre mot de passe";
            }else $msg = "Les mots de passe ne sont pas identiques";
        }else $msg = "Le mot de passe n'est pas correcte";
    }

    if (isset($_POST['retour'])) {
        header("Location: connexion.php");
    }
    if (isset($_POST['deconect'])) {
        session_unset();
        header("Location: connexion.php");
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
            <a href="../index">Accueil</a>
            <a href="planning.php">Planning</a>
            <div>
                <img class="img1" src="../issets/images/wedding-ring.svg" alt="logo">
                <img class="img2" src="../issets/images/wedding-ring 2.svg" alt="logo">
            </div>
            <a href="profil.php"><u>Profil</u></a>
            <a href="reservation-form.php">Réserver</a>
        </nav>
    </header>
    <main class="form_profil">
        <section>
            <div>
                <img src="../issets/images/dove.svg" alt="photo">
                <p>MON PROFIL</p>
            </div>
            <div class="form_profil_2">
                <div>
                    <form method="post">
                        <?php if (isset($_POST['s_n_u'])) {
                            echo $msg;
                        }  ?>
                        <input type="text" name="new_user" placeholder="Nouveau Login">
                        <input type="password" name="password" placeholder="Mot d passe">
                        <input type="submit" name="s_n_u" value="valider">
                    </form>
                </div>
                <div class="vide"></div>
                <div>
                    <form method="post">
                    <?php if (isset($_POST['s_n_p'])) {
                            echo $msg;
                        }  ?>
                        <input type="password" name="password" placeholder="Ancien mot d passe">
                        <input type="password" name="new_password" placeholder="Nouveau mot d passe">
                        <input type="password" name="cNaw_password" placeholder="Confirmer le nouveau mot d passe">
                        <input type="submit" name="s_n_p" value="valider">
                    </form>
                </div>
            </div>
            <div>
                <form method="post">
                    <input type="submit" name="retour" value="Retour">
                    <input type="submit" name="deconect" value="Déconnexion">
                </form>
            </div>
        </section>
    </main>
    <footer></footer>
</body>

</html>