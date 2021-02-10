<!DOCTYPE html>
<?php
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

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="./res/css/cover.css" rel="stylesheet">
</head>

<body class="d-flex h-100 text-center text-white bg-dark">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <?php include_once(__DIR__ . DIRECTORY_SEPARATOR . "res" . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR . "header.inc.php") ?>

        <main class="px-3">
            <h1>Log IP</h1>
            <p class="lead">Ce site permet de localiser où se situent vos attaques.</p>
            <p class="lead">Veuillez insérez un fichier access_log, par la suite une map s'affichera pour visualiser d'où viennent les attaques.</p>
            <div class="lead">
                <form action="map.php" method="POST" enctype="multipart/form-data">
                    <!-- <div class=""> -->
                    <input class="form-control mb-3" type="file" accept=".log" id="formFile" name="<?= INPUT_FILE ?>">
                    <!-- </div> -->
                    <input class="btn btn-light" type="submit" name="<?= INPUT_SUBMIT ?>" value="Envoyer">
                </form>
            </div>
        </main>

        <?php include_once(__DIR__ . DIRECTORY_SEPARATOR . "res" . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR . "footer.inc.php") ?>
    </div>

</body>

</html>