<?php

include_once 'Database.php';


session_start();

header('Content-Type: text/html; charset=utf-8');


function index() : string {
    return <<<END
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
                    <input type="number" name="jours" placeholder="nombre de jours de location" required><br>
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
}

if (!isset($_SESSION['database'])) {
    header('Location: index.php');
}

$action = $_GET['action'] ?? null;

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
            $categorie = filter_var($_POST['categorie'], FILTER_SANITIZE_SPECIAL_CHARS);
            $dateD = filter_var($_POST['dateD'], FILTER_SANITIZE_SPECIAL_CHARS);
            $dateF = filter_var($_POST['dateF'], FILTER_SANITIZE_SPECIAL_CHARS);
            $dateD = date('Y/m/d', strtotime($dateD));
            $dateF = date('Y/m/d', strtotime($dateF));

            $statement = $bdd->prepare(<<<END
                SELECT DISTINCT VEHICULE.NO_IMM, MODELE FROM VEHICULE where CODE_CATEG = :categorie
                EXCEPT 
                SELECT DISTINCT VEHICULE.NO_IMM, MODELE FROM VEHICULE 
                inner join CALENDRIER on VEHICULE.NO_IMM = CALENDRIER.NO_IMM where CODE_CATEG = :categorie
                and (DATEJOUR BETWEEN :dateD and :dateF) and PASLIBRE IS NOT NULL
            END);
            $statement->bindParam(':categorie', $categorie);
            $statement->bindParam(':dateD', $dateD);
            $statement->bindParam(':dateF', $dateF);

            $statement->execute();

            $temp = '';

            while ($row = $statement->fetch()) {
                $temp .= '<tr>';
                $temp .= '<td>' . $row['NO_IMM'] . '</td>';
                $temp .= '<td>' . $row['MODELE'] . '</td>';
                $temp .= '</tr>';
            }

            if ($temp == '') {
                $temp = '<p>Aucun résultat</p>';
            } else {
                $temp = <<<END
                    <table>
                        <tr>
                            <th>NO_IMM</th>
                            <th>MODELE</th>
                        </tr>
                        $temp
                    </table>
                    END;
            }

            $html .= $temp;

            break;
        case 'question2':
            $immat = filter_var($_POST['immat'], FILTER_SANITIZE_SPECIAL_CHARS);
            $dateD = filter_var($_POST['dateD'], FILTER_SANITIZE_SPECIAL_CHARS);
            $dateF = filter_var($_POST['dateF'], FILTER_SANITIZE_SPECIAL_CHARS);
            $dateD = date('Y/m/d', strtotime($dateD));
            $dateF = date('Y/m/d', strtotime($dateF));

            $statement = $bdd->prepare(<<<END
                SELECT no_imm from calendrier where no_imm = :immat
                    and NOT EXISTS (SELECT no_imm from calendrier where DATEJOUR 
                    between :dateD and :dateF and no_imm = :immat and paslibre = 'x')
            END);
            $statement->bindParam(':immat', $immat);
            $statement->bindParam(':dateD', $dateD);
            $statement->bindParam(':dateF', $dateF);

            $statement->execute();

            if ($row = $statement->fetch()) {
                $statement = $bdd->prepare(<<<END
                    UPDATE calendrier set paslibre = 'x' where no_imm = :immat
                        and DATEJOUR between :dateD and :dateF
                END);
                $statement->bindParam(':immat', $immat);
                $statement->bindParam(':dateD', $dateD);
                $statement->bindParam(':dateF', $dateF);

                $statement->execute();

                $html .= '<p>La mise à jour a été effectuée</p>';
            } else {
                $html .= '<p>Le vehicule n\'est pas disponible pour cette periode</p>';
            }

            break;
        case 'question3':
            $modele = filter_var($_POST['modele'], FILTER_SANITIZE_SPECIAL_CHARS);
            $jours = (int) filter_var($_POST['jours'], FILTER_SANITIZE_NUMBER_INT);

            $statement = $bdd->prepare(<<<END
                select tarif_hebdo*(:jours-MOD(:jours,7))/7 + tarif_jour* MOD(:jours,7) from vehicule
                    inner join categorie on vehicule.code_categ = categorie.code_categ
                    inner join tarif on categorie.code_tarif = tarif.code_tarif
                    where modele = :modele
            END);
            $statement->bindParam(':jours', $jours);
            $statement->bindParam(':modele', $modele);

            $statement->execute();

            $temp = '';

            if ($row = $statement->fetch()) {
                $temp = '<p>Le montant de la location est de ' . $row[0] . '€</p>';
            } else {
                $temp = '<p>Aucun résultat</p>';
            }

            $html .= $temp;

            break;
        case 'question4':
            $statement = $bdd->prepare("SELECT CODE_AG FROM AGENCE where CODE_AG not in (select CODE_AG from AGENCE where CODE_AG not in(select DISTINCT CODE_AG from VEHICULE))");
            $statement->execute();

            $temp = '';

            while ($result = $statement->fetch()) {
                $temp .= "<p>$result[0]</p>";
            }

            if ($temp == '') {
                $temp = '<p>Aucun resultat</p>';
            } else {
                $temp = '<p>Les agences qui possèdent toutes les catégories de véhicules sont :</p>' . $temp;
            }

            $html .= $temp;

            break;
        case 'question5':

            $statement = $bdd->prepare("select NOM,VILLE,CODPOSTAL from CLIENT where CODE_CLI in(select CODE_CLI from DOSSIER D1 where D1.CODE_CLI in (select CODE_CLI from DOSSIER where NO_IMM != D1.NO_IMM))");
            $statement->execute();

            $temp = '';

            while ($result = $statement->fetch()) {
                $temp .= "<p>$result[0] $result[1] $result[2]</p>";
            }

            if ($temp == '') {
                $temp = '<p>Aucun resultat</p>';
            } else {
                $temp = '<p>Les clients qui ont loué deux modèles différents de voiture sont :</p>' . $temp;
            }

            $html .= $temp;

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