<?php

include_once 'Database.php';


session_start();

header('Content-Type: text/html; charset=utf-8');


function index() : string {
    $temp = <<<END
                <form id="deco" method="post" action="?action=deco">
                    <button type="submit">Deconnexion</button>
                </form>
                <h3>Détermination de la liste des véhicules (immatriculation, modèle), d’une catégorie donnée, disponibles pendant une période donnée (date début, date fin).</h3>
                <form id="question1" method="post" action="?action=question1">
                    <input type="text" name="categorie" placeholder="categorie du vehicule" required><br>
                    <input type="date" name="dateD" placeholder="date de debut" required><br>
                    <input type="date" name="dateF" placeholder="date de fin" required><br>
                    <button type="submit">Submit</button><br>
                </form>  

                <h3>Mise à jour du calendrier des réservations pour une période donnée (date de début et de fin d’une demande de location) et un numéro d’immatriculation d’un véhicule.</h3>

                <form id="question2" method="post" action="?action=question2">
                    <input type="date" name="dateD" placeholder="date de debut" required><br>
                    <input type="date" name="dateF" placeholder="date de fin" required><br>
                    <input type="text" name="immat" placeholder="immatriculation" required><br>
                    <button type="submit">Submit</button><br>
                </form>

                <h3>Calcul du montant d’une location à partir du modèle de véhicule et du nombre de jours de location.</h3>

                <form id="question3" method="post" action="?action=question3">
                    <input type="text" name="modele" placeholder="modele du vehicule" required><br>
                    <input type="number" name=jours" placeholder="nombre de jours de location" required><br>
                    <button type="submit">Submit</button><br>
                </form>



                <h3>Affichage de la liste des agences (code de l’agence) qui possèdent toutes les catégories de véhicules.</h3>

                <form id="question4" method="post" action="?action=question4">
                    <button type="submit">Submit</button><br>
                </form>



                <h3>Affichage de la liste des clients (nom, ville, code postal) qui ont loué deux modèles différents de voiture (par exemple xsara et twingo).</h3>

                <form id="question5" method="post" action="?action=question5">
                    <button type="submit">Submit</button><br>
                </form>
               END;
    return $temp;
}

if (!isset($_SESSION['database'])) {
    header('Location: index.php');
}

$action = isset($_GET['action']) ? $_GET['action'] : null;

$html = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $database = unserialize($_SESSION['database']);
    $bdd = $database->connect();

    switch ($action) {
        case 'deco':
            session_destroy();
            header('Location: index.php');
            break;
        case 'question1':


            break;
        case 'question2':
            break;
        case 'question3':
            break;
        case 'question4':
            $statement = $bdd->prepare("SELECT CODE_AG FROM AGENCE where CODE_AG not in (select CODE_AG from AGENCE where CODE_AG not in(select DISTINCT CODE_AG from VEHICULE))");
            $statement->execute();

            while ($result = $statement->fetch()) {
                $html .= "<p>{$result[0]}</p>";
            }

            break;
        case 'question5':

            $statement = $bdd->prepare("select NOM,VILLE,CODPOSTAL from CLIENT where CODE_CLI in(select CODE_CLI from DOSSIER D1 where D1.CODE_CLI in (select CODE_CLI from DOSSIER where NO_IMM != D1.NO_IMM))");
            $statement->execute();

            while ($result = $statement->fetch()) {
                $html .= "<p>{$result[0]} {$result[1]} {$result[2]}</p>";
            }

            break;
        default:
            $html = index();
            break;
    }

    $html .= "<br><a href='menu.php'>Retour</a>";

} else {
    $html = index();
}

echo $html; 