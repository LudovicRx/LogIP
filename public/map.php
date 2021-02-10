<!DOCTYPE html>
<?php
require_once(__DIR__ . DIRECTORY_SEPARATOR . "res" . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "app.inc.php");
$formatedData = array();

if (filter_input(INPUT_POST, INPUT_SUBMIT, FILTER_SANITIZE_STRING)) {
    if (isset($_FILES[INPUT_FILE])) {
        // Vérifie que l'extension est .log
        if (pathinfo($_FILES[INPUT_FILE]["name"], PATHINFO_EXTENSION) == "log") {
            $path = __DIR__ . DIRECTORY_SEPARATOR . "res"  . DIRECTORY_SEPARATOR . "data"  . DIRECTORY_SEPARATOR . "access.log";
            move_uploaded_file($_FILES[INPUT_FILE]["tmp_name"], $path);
            $formatedData = formatData(getParsedFile($path));
        }
    }
}

?>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>LogIP</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/cover/">


    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />

    <!-- Favicons -->
    <meta name="theme-color" content="#7952b3">

    <!-- Custom styles for this template -->
    <link href="./res/css/cover.css" rel="stylesheet">
</head>

<body class="d-flex h-100 text-center text-white bg-dark">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column mw-75">
        <?php include_once(__DIR__ . DIRECTORY_SEPARATOR . "res" . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR . "header.inc.php") ?>

        <main class="px-3 mb-2 mt-2 h-100">
            <div id="mapid" class="h-100"></div>
        </main>

        <?php include_once(__DIR__ . DIRECTORY_SEPARATOR . "res" . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR . "footer.inc.php") ?>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script type="text/javascript" src="js/map.js"></script>
    <script>
        createMap();
        var data = <?= json_encode($formatedData) ?>;
        if(data.length > 0) {
            drawMarkers(data);
        }
    </script>
</body>

</html>