<!DOCTYPE html>
<?php
// Projet    :   Log IP
// Auteur    :   Ludovic Roux
// Desc.     :   Page qui s'affiche lorsqu'il y a une erreur
// Version   :   1.0, 14.04.2021, LR, version initiale

require_once(__DIR__ . DIRECTORY_SEPARATOR . "res" . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "app.inc.php");
?>
<html lang="fr" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>LogIP</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/cover/">

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Favicons -->
    <meta name="theme-color" content="#7952b3">

    <!-- Custom styles for this template -->
    <link href="./res/css/cover.css" rel="stylesheet">
</head>

<body class="d-flex h-100 text-center text-white bg-dark">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <?php include_once(__DIR__ . DIRECTORY_SEPARATOR . "res" . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR . "header.inc.php") ?>

        <main class="px-3">
            <h1>Log IP</h1>
            <p class="lead">Une erreur est survenue ;-;</p>
            <div class="lead">
                <a href="index.php">Appuyez ici pour revenir à la page d'acceuil</a>
            </div>
        </main>

        <?php include_once(__DIR__ . DIRECTORY_SEPARATOR . "res" . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR . "footer.inc.php") ?>
    </div>

</body>

</html>