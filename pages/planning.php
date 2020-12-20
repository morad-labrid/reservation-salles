<?php
session_start();
include("db.php");

if (!$_SESSION['login']) {
    $nav = '
        <a href="../index.php">Accueil</a>
        <a href="Planning.php"><u>Planning</u></a>
        <div>
            <img class="img1" src="../issets/images/wedding-ring.svg" alt="logo">
            <img class="img2" src="../issets/images/wedding-ring 2.svg" alt="logo">
        </div>
        <a href="inscription.php">Inscription</a>
        <a href="connexion.php">Connexion</a>
        ';
}else $nav =  '
        <a href="../index.php">Accueil</a>
        <a href="planning.php"><u>Planning</u></a>
        <div>
            <u><img class="img1" src="../issets/images/wedding-ring.svg" alt="logo"></u>
            <img class="img2" src="../issets/images/wedding-ring 2.svg" alt="logo">
        </div>
        <a href="profil.php">Profil</a>
        <a href="reservation-form.php">Réserver</a>
        ';
// Convertit une date ou un timestamp en français
function dateToFrench($date, $format)
{
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date))));
}
$today = dateToFrench('now', "l,") . "<br>" . dateToFrench('now', "j F");

?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/d34f22fe3f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../issets/css/styles.css">
    <title>CONNEXION | SALLE MARIAGE</title>
</head>

<body>
    <header class="m_header">
        <nav>
            <?php echo $nav ?>
        </nav>
    </header>
    <main class="planning">
        <!-- SIDEBAR -->
        <section class="sidbar">
            <div>
                <p>On est le</p>
                <h1><?php echo $today ?></h1>
            </div>
            <div class="info">
                <div>
                    <i class="fas fa-dot-circle"></i>
                    <p>--Disponible</p>
                </div>
                <div>
                    <i class="fas fa-dot-circle"></i>
                    <p>--Reservé</p>
                </div>
                <div>
                    <i class="fas fa-dot-circle"></i>
                    <p>--Fermé</p>
                </div>
            </div>
            <div>
                <button onclick="window.location.href='reservation-form.php';">Réserver un événement</a></button>
            </div>
        </section>
        <!-- FIN SIDEBAR -->

        <section class="agenda">
            <div>
                <!-- <div>
                    <p>DECEMBRE 2020</p>
                </div> -->
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <form action="" method="post" class="plus_moins">
                                        <button type="submit" name="moins_un"><</button>
                                        <button type="submit" name="plus_un">></button>
                                    </form>
                                </th>
                                <th>14h - 15h</th>
                                <th>15h - 16h</th>
                                <th>16h - 17h</th>
                                <th>17h - 18h</th>
                                <th>18h - 19h</th>
                                <th>19h - 20h</th>
                                <th>20h - 21h</th>
                                <th>21h - 22h</th>
                                <th>22h - 23h</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST['plus_un'])) {
                                    $_SESSION['plus']++;
                                }elseif (isset($_POST['moins_un'])) {
                                    $_SESSION['plus']--;
                                } else $_SESSION['plus']=0;

                            for ($i = $_SESSION['plus']; $i < ($_SESSION['plus']+7); $i++) {
                                echo "<tr>";
                                echo "<td>". $todayPlus = dateToFrench("now +$i day", "l") . "<br>" . dateToFrench("now +$i day", "j F"). "</td>";
                                if (dateToFrench("now +$i day", "l") === "samedi" || dateToFrench("now +$i day", "l") === "dimanche") {
                                    $dispo = "week";
                                    $text = "Fermé";
                                }else {
                                    $dispo = "dispo";
                                    $text = "Disponible";
                                }
                                for ($h = 14; $h < 23; $h++) {
                                    $dateSelected = dateToFrench("now +$i day", "Y-n-j $h");
                                    $select = $conn->prepare("SELECT * FROM reservations WHERE debut = '$dateSelected' ");
                                    $select->execute();
                                    $select = $select->fetch(PDO::FETCH_ASSOC);
                                    if ($select) {
                                        $id_utilisateur = $select['id_utilisateur'];
                                        $select_id = $conn->prepare("SELECT * FROM utilisateurs WHERE id = '$id_utilisateur' ");
                                        $select_id->execute();
                                        $select_id = $select_id->fetch(PDO::FETCH_ASSOC);
                                    }
                                    if ($select) {
                                        $login = $select_id['login'];
                                        $titre = $select['titre'];
                                        $id_event = $select['id'];
                                    }
                                    if ($select) {
                                            echo "<td class='reserved'>$titre<br>
                                            <a href='reservation.php?id=$id_event'>$login</a>
                                            </td>";
                                    } else  echo "<td class='$dispo'>$text</td>";
                                }
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
    <footer></footer>
</body>

</html>