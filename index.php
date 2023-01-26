<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('connection/connection.php');

define('INTERVALO', 3);

// totalArtigos = 7
// numPaginas = arredondar para cima(totalArtigos / INTERVALO)
// 1 - limite=3&offset=0
// 2 - limite=3&offset=3
// 3 - limite=3&offset=6

$qArtigos = "SELECT idArtigo,tituloArtigo,textoArtigo,dataArtigo FROM artigos ORDER BY dataArtigo DESC LIMIT ? OFFSET ?";
$stmtArtigos = $conn->prepare($qArtigos);
if ($stmtArtigos === FALSE) {
    die("Erro no SQL: " . $qArtigos . " Error: " . $conn->error);
}
if (isset($_GET['offset']) && $_GET['offset'] != "") {
    $offset = $_GET['offset'];
} else {
    $offset = 0;
}
// $offset=0;
$numArtigos = INTERVALO;
$stmtArtigos->bind_param('ii', $numArtigos,$offset);
$stmtArtigos->execute();
$stmtArtigos->store_result();
$totalArtigos = $stmtArtigos->num_rows;
// como exemplo, podemos fazer um select count(*) para verificar o número de artigos
$contaTotalArtigos = 7;
$quantasPaginas = ceil($contaTotalArtigos / INTERVALO);

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
        $stmtArtigos->bind_result($idArtigo, $tituloArtigo, $textoArtigo, $dataArtigo);
        while ($stmtArtigos->fetch()) {
        ?>
            <div class="card">
                <div class="card-header">
                    <?= $dataArtigo ?>
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p><?= $tituloArtigo ?></p>
                        <footer class="blockquote-footer"><?= substr($textoArtigo, 0, 250) ?>......</footer>
                    </blockquote>
                </div>
            </div>
            <br>
        <?php } ?>
        <?php
        if ($numArtigos <= $totalArtigos) {
        ?>
            <a href="index.php?numArtigos=<?= $numArtigos + INTERVALO ?>" class="btn btn-primary">Carregar mais artigos...</a>
        <?php } else {
            echo "<h3>Chegou ao final dos artigos!</h3>";
        } ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php 
                    $offsetLink = 0;
                    for($i=1; $i<=$quantasPaginas; $i++) { ?>
                        <li class="page-item"><a class="page-link" href="index.php?offset=<?= $offsetLink ?>"><?= $i ?></a></li>
                  <?php  
                    $offsetLink += INTERVALO;
                    } ?>
                
            </ul>
        </nav>
    </div>
    <?php
    $stmtArtigos->close();
    $conn->close();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>