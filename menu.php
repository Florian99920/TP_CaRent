<?php

session_start();

function index() : string {
    $temp = <<<END
                <form id="deco" method="post" action="?action=deco">
                    <button type="submit">Deconnexion</button>
                </form>
                <h3>Détermination de la liste des véhicules (immatriculation, modèle), d’une catégorie donnée, disponibles pendant une période donnée (date début, date fin).</h3>
                <form id="question1" method="post" action="?action=question1">
                    <input type="text" name="categorie" placeholder="categorie du vehicule"><br>
                    <input type="date" name="dateD" placeholder="date de debut"><br>
                    <input type="date" name="dateF" placeholder="date de fin"><br>
                    <button type="submit">Submit</button><br>
                </form>  

                <h3>Mise à jour du calendrier des réservations pour une période donnée (date de début et de fin d’une demande de location) et un numéro d’immatriculation d’un véhicule.</h3>

                <form id="question2" method="post" action="?action=question2">
                    <input type="date" name="dateD" placeholder="date de debut"><br>
                    <input type="date" name="dateF" placeholder="date de fin"><br>
                    <input type="text" name="immat" placeholder="immatriculation"><br>
                    <button type="submit">Submit</button><br>
                </form>

                <h3>Calcul du montant d’une location à partir du modèle de véhicule et du nombre de jours de location.</h3>

                <form id="question3" method="post" action="?action=question3">
                    <input type="text" name="modele" placeholder="modele du vehicule"><br>
                    <input type="number" name=jours" placeholder="nombre de jours de location"><br>
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
            break;
        case 'question5':
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