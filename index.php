<?php

include_once 'Database.php';

session_start();

header('Content-Type: text/html; charset=utf-8');

$html = '';

if (isset($_SESSION['database'])) {
    header('Location: menu.php');
} else {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $host = filter_var($_POST['host'], FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $user = filter_var($_POST['user'], FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);

        try {
            $database = new Database($host, $name, $user, $password);
            $_SESSION['database'] = serialize($database);
            header('Location: menu.php');
        } catch (Exception $e) {
            $html .= '<p>Erreur lors de la connexion à la base de données</p><br>';
            $html .= '<p>' . $e->getMessage() . '</p><br>';
            $html .= '<p><a href="index.php">Retour</a></p>';
        }

    } else {
        $html .= "<h1>Connexion à la base de données</h1>";
        $html .= <<<END
        <form action="index.php" method="post">
            <label for="host">Host</label>
            <input type="text" name="host" id="host>
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
            <label for="user">User</label>
            <input type="text" name="user" id="user">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <input type="submit" value="Connexion">
        </form>
        END;
    }
}

echo $html;