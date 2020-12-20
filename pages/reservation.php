<?php

    session_start();
    include("db.php");
    if (!isset($_SESSION['login'])) {
        header("Location: connexion.php");
    }
    $id_resa = $_GET['id'];

    $infoResa = $conn->prepare("SELECT * FROM reservations WHERE id = '$id_resa' ");
    $infoResa->execute();
    $infoResa = $infoResa->fetch(PDO::FETCH_ASSOC);
    $id_utilisateur = $infoResa['id_utilisateur'];
    
    $loginInfo = $conn->prepare("SELECT * FROM utilisateurs WHERE id = '$id_utilisateur' ");
    $loginInfo->execute();
    $loginInfo = $loginInfo->fetch(PDO::FETCH_ASSOC);
    $loginInfo = $loginInfo['login'];

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../issets/css/styles.css">
    <title>FORMULAIRE | SALLE MARIAGE</title>
</head>

<body>
    <header class="m_header">
        <nav>
            <a href="../index">Accueil</a>
            <a href="planning.php">Planning</a>
            <div>
                <u><img class="img1" src="../issets/images/wedding-ring.svg" alt="logo"></u>
                <img class="img2" src="../issets/images/wedding-ring 2.svg" alt="logo">
            </div>
            <a href="profil.php">Profil</a>
            <a href="reservation-form.php">Réserver</a>
        </nav>
    </header>
    <main class="infoResa">
        <section>
           <?php
                echo "<div>";
                echo "<img class='img3' src='../issets/images/dove.svg' alt='logo'><br>";
                echo $infoResa['titre']."<br>";
                echo "par: $loginInfo<br>";
                echo "Description: ".$infoResa['description']."<br>";
                echo "du ". $infoResa['debut']."<br>";
                echo "au ". $infoResa['fin']."<br>";
                echo "<a href='planning.php'>Retour</a>";
                echo "</div>";
            ?> 
        </section>
    </main>
    <footer>
        <p>COPYRIGHT © ALL RIGHT RESERVED</p>
    </footer>
</body>

</html>