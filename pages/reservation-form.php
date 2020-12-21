<?php

    session_start();
    include("db.php");
    if (!isset($_SESSION['login'])) {
        header("Location: connexion.php");
    }
        ///////////////////////////////////////////
        if (!isset($_SESSION['login'])) {
            header("Location: connexion.php");
        }
        // Convertit une date ou un timestamp en français
        function dateToFrench($date, $format)
        {
            $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
            $french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
            $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
            $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
            return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date))));
        }
        ///////////////////////////////////////////
        // $dated=$_POST['date'];
        // $dated =  dateToFrench("$dated", 'l', strtotime($dated));
        // echo $dated ."<br>";
        // $dim = 'dimanche';
        // $sam = 'samedi';
        // if ($dated == $dim || $dated == $sam) {
        //     echo "desole nous sommes fermé";
        // }else echo "nous sommes ouvert";



        // crée un tableau pour stocker les messages d'erreur
        $msg = [];
        if (isset($_POST["submit"])) {
            // id de l'utilisateur /////////////////////////////////////////////////
            $session = $_SESSION['login'];
            $id      = $conn -> prepare(" SELECT * FROM utilisateurs WHERE login = :session ");
            $id -> bindParam("session", $session);
            $id -> execute();
            $id = $id -> fetchObject();
            $id_utilisateur = $id->id;
            /////////////////////////////////////////////////////////////////////////
            $titre         = $_POST["titre"];
            $description   = $_POST["description"];
            $date          = $_POST["date"];
            $heureDebut    = $_POST["heureDebut"];
            $heureFin      = $_POST["heureFin"];
            $nombreHeure   = $heureFin - $heureDebut;
            $heureAenvoyer = $heureFin - $nombreHeure +1;
            /////////////////////////////////////////////////////////////////////////
            $existeDate = $conn -> prepare(" SELECT * FROM reservations ");
            $existeDate -> execute();
            while ($nombreHeure > 0) {
                $dateCompleteDebut = $date . " " . $heureDebut;
                $dateCompleteFin   = $date . " " . $heureAenvoyer;
                // echo "$dateCompleteDebut to $dateCompleteFin <br>";
                $existeDate = $conn -> prepare(" SELECT debut FROM reservations WHERE debut = '$dateCompleteDebut'");
                $existeDate -> execute();
                $existeDate = $existeDate->fetch(PDO::FETCH_ASSOC);
                $existeDate = $existeDate['debut'];
                $heureAenvoyer++;
                $heureDebut++;
                $nombreHeure--;
                if (isset($existeDate)) {
                    array_push($msg, "");
                }
            }
            /////////////////////////////////////////////////////////////////////////
            if (!empty($titre) && !empty($description) && !empty($date) && !empty($heureDebut) && !empty($heureFin)) {
                $titre         = $_POST["titre"];
                $description   = $_POST["description"];
                $date          = $_POST["date"];
                $heureDebut    = $_POST["heureDebut"];
                $heureFin      = $_POST["heureFin"];
                $nombreHeure   = $heureFin - $heureDebut;
                $heureAenvoyer = $heureFin - $nombreHeure +1;

                if ($existeDebut == false && $existeFin == false) {
                    if ($_POST['date'] >= date("Y-n-j")) {
                        $dated = $_POST['date'];
                        $dated =  dateToFrench("$dated", 'l', strtotime($dated));
                        $dim = 'dimanche';
                        $sam = 'samedi';
                        if ($dated == $dim || $dated == $sam) {
                            array_push($msg, "Nous sommes désolés, nous fermons le $dated");
                        }

                        elseif ($heureDebut < $heureFin) {
                            $count = count($msg);
                            if ($count == 0) {
                                while ($nombreHeure > 0) {
                                    $dateCompleteDebut = $date . " " . $heureDebut;
                                    $dateCompleteFin = $date . " " . $heureAenvoyer;
                                        $insert = $conn -> prepare("INSERT INTO reservations (titre, description, debut, fin, id_utilisateur) 
                                        VALUES ('$titre', '$description', '$dateCompleteDebut', '$dateCompleteFin', '$id_utilisateur')");
                                        // $insert -> bindParam("titre", $titre);
                                        // $insert -> bindParam("description", $description);
                                        // $insert -> bindParam("debut", $dateCompleteDebut);
                                        // $insert -> bindParam("fin", $dateCompleteFin);
                                        // $insert -> bindParam("id_utilisateur", $id_utilisateur);
                                        $insert -> execute();
                                    $heureAenvoyer++;
                                    $heureDebut++;
                                    $nombreHeure--;
                                }
                            }else array_push($msg, "L'heure ou les heuraire que vous avez choisir no sont pas disponible(s)");
                        }else array_push($msg, "L'heure de fin doit être supérieur l'heure de début<br>");
                    }else array_push($msg, "La date doit etre egale ou superieur a la date d'aujourd'hui");
                }else array_push($msg, "Les créneaux que vous avez sélectionné sont deja réserver. Redirigez vous vers le planning pour voir la disponibilité<br>");
            }else array_push($msg, "Veuillez remplir tous les champs svp<br>");
        }
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
            <a href="reservation-form.php"><u>Réserver</u></a>
        </nav>
    </header>
    <main class="formulaire">
        <section>
            <form action="" method="POST">
                <div>
                    <img class="img2" src="../issets/images/wedding-ring 2.svg" alt="logo">
                    <p>RESERVER UNE SALLE</p>
                </div>
                <div class="msg_erreur">
                <?php  
                    foreach ($msg as $msg_erreur) {
                    echo "<p>$msg_erreur<p>";
                }
                ?>
                </div>
                
                <label for="username"></label>
                <input type="text" name="titre" id="titre" placeholder="Titre de votre evenement">

                <label for="description"></label>
                <textarea name="description" id="description" placeholder="description"></textarea>

                <label for="date"></label>
                <input type="date" name="date" id="date">
                <div class="heure">
                    <label for="heureDebut">Heure:</label>
                    <select name="heureDebut" id="debut">
                        <option value="14">de 14:00h</option>
                        <option value="15">de 15:00h</option>
                        <option value="16">de 16:00h</option>
                        <option value="17">de 17:00h</option>
                        <option value="18">de 18:00h</option>
                        <option value="19">de 19:00h</option>
                        <option value="20">de 20:00h</option>
                        <option value="21">de 21:00h</option>
                        <option value="22">de 22:00h</option>
                    </select>
                    <select name="heureFin" id="fin">
                        <option value="15">de 15:00h</option>
                        <option value="16">de 16:00h</option>
                        <option value="17">de 17:00h</option>
                        <option value="18">de 18:00h</option>
                        <option value="19">de 19:00h</option>
                        <option value="20">de 20:00h</option>
                        <option value="21">de 21:00h</option>
                        <option value="22">de 22:00h</option>
                        <option value="23">de 23:00h</option>
                    </select>
                </div>
                

                <input type="submit" name="submit" value="VALIDER">
            </form>
        </section>
    </main>
    <footer>
        <p>COPYRIGHT © ALL RIGHT RESERVED</p>
    </footer>
</body>

</html>