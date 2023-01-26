<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('connection/connection.php');

if (isset($_GET['idArtigo']) && $_GET['idArtigo'] != "") {
    $qArtigos = "SELECT idArtigo,tituloArtigo,textoArtigo,dataArtigo FROM artigos WHERE idArtigo = ?";
    $stmtArtigos = $conn->prepare($qArtigos);
    if ($stmtArtigos === FALSE) {
        die("Erro no SQL: " . $qArtigos . " Error: " . $conn->error);
    }
    $stmtArtigos->bind_param('i', $_GET['idArtigo']);
    $stmtArtigos->execute();
    $stmtArtigos->bind_result($idArtigo, $tituloArtigo, $textoArtigo, $dataArtigo);
    $stmtArtigos->fetch();
} else {
    header("Location: index.php");
}

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
        <div class="card">
            <div class="card-header">
                <?= $dataArtigo ?>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p><?= $tituloArtigo ?></p>
                    <footer class="blockquote-footer"><?= $textoArtigo ?></footer>
                </blockquote>
            </div>
        </div>
    </div>
    <?php
    $stmtArtigos->close();
    $conn->close();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>