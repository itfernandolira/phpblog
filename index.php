<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('connection/connection.php');

$qArtigos = "SELECT idArtigo,tituloArtigo,textoArtigo,dataArtigo FROM artigos ORDER BY dataArtigo DESC";
$stmtArtigos = $conn->prepare($qArtigos);
if ($stmtArtigos === FALSE) {
    die("Erro no SQL: " . $qArtigos . " Error: " . $conn->error);
}
$stmtArtigos->execute();
$stmtArtigos->store_result();
$numArtigos = $stmtArtigos->num_rows;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>BLOG</h1>
        <h2>Artigos</h2>
        <?php 
            $stmtArtigos->bind_result($idArtigo,$tituloArtigo,$textoArtigo,$dataArtigo);
            while ($stmtArtigos->fetch()) { 
        ?>
            <div class="card">
                <div class="card-header">
                    <?= $dataArtigo ?>
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p><?= $tituloArtigo ?></p>
                        <footer class="blockquote-footer"><?= substr($textoArtigo,0,250) ?>......</footer>
                    </blockquote>
                </div>
            </div>
            <br>
        <?php } ?>
    </div>
    <?php
    $stmtArtigos->close();
    $conn->close();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>