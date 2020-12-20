<?php
    session_start();
    include("pages/db.php");

    if (!$_SESSION['login']) {
        $nav = '
            <a href="index.php"><u>Accueil</u></a>
            <a href="pages/Planning.php">Planning</a>
            <div>
                <img class="img1" src="issets/images/wedding-ring.svg" alt="logo">
                <img class="img2" src="issets/images/wedding-ring 2.svg" alt="logo">
            </div>
            <a href="pages/inscription.php">Inscription</a>
            <a href="pages/connexion.php">Connexion</a>
            ';
    }else $nav =  '
            <a href="index.php"><u>Accueil</u></a>
            <a href="pages/planning.php">Planning</a>
            <div>
                <u><img class="img1" src="issets/images/wedding-ring.svg" alt="logo"></u>
                <img class="img2" src="issets/images/wedding-ring 2.svg" alt="logo">
            </div>
            <a href="pages/profil.php">Profil</a>
            <a href="pages/reservation-form.php">Réserver</a>
            ';
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="issets/css/styles.css">
    <title>SALLE MARIAGE</title>
</head>

<body>
    <header class="m_header">

        <nav>
            <?php echo $nav ?>
        </nav>

    </header>
    <main class="index">
        <section>
            <div>
                <img src="issets/images/background1.jpg" alt="photo">
                <h3>Trouvez la salle idéale pour votre mariage</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum dolor fugit hic maiores iste
                    deleniti non ut asperiores, omnis quas natus et deserunt error voluptates modi, minima cupiditate
                    numquam possimus.
                </p>
            </div>
            <div>
                <img src="issets/images/background2.jpg" alt="photo">
                <h3>Trouvez la salle idéale pour votre mariage</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum dolor fugit hic maiores iste
                    deleniti non ut asperiores, omnis quas natus et deserunt error voluptates modi, minima cupiditate
                    numquam possimus.
                </p>
            </div>
            <div>
                <img src="issets/images/background3.jpg" alt="photo">
                <h3>Trouvez la salle idéale pour votre mariage</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum dolor fugit hic maiores iste
                    deleniti non ut asperiores, omnis quas natus et deserunt error voluptates modi, minima cupiditate
                    numquam possimus.
                </p>
            </div>
        </section>
        <div class="div_index">

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo, deserunt tenetur. Laborum, est eligendi. Quis ut voluptas iste, quibusdam voluptates tempora quidem excepturi qui commodi aliquid minus voluptate tempore ipsa!</p>
            <button onclick="window.location.href='pages/reservation-form.php';">Réserver un événement</a></button>
        </div>
    </main>
    <footer>
        <p>COPYRIGHT © ALL RIGHT RESERVED</p>
    </footer>
</body>

</html>