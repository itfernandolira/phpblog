<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../connection/connection.php');

if (!isset($_SESSION['utilizador'])) {
    header("Location: login.php");
}

if (isset($_POST['acao']) && $_POST['acao']=='apagar') {
    $sqlArtigo = "DELETE FROM artigos WHERE idArtigo=?";
    $stmtDelArtigo = $conn->prepare($sqlArtigo);
    if ($stmtDelArtigo === FALSE) {
        die("Erro no SQL: " . $sqlArtigo . " Error: " . $conn->error);
    }
    $idArtigo = $_POST['idartigo'];
    $stmtDelArtigo->bind_param('i', $idArtigo);
    $stmtDelArtigo->execute();
    $stmtDelArtigo->close();
}

if (isset($_POST['titulo']) && $_POST['titulo'] != "") {
    $sqlArtigo = "INSERT INTO artigos(tituloArtigo,textoArtigo) VALUES(?,?)";
    $stmtInsArtigo = $conn->prepare($sqlArtigo);
    if ($stmtInsArtigo === FALSE) {
        die("Erro no SQL: " . $sqlArtigo . " Error: " . $conn->error);
    }
    $titulo = $_POST['titulo'];
    $texto = $_POST['texto'];
    $stmtInsArtigo->bind_param('ss', $titulo, $texto);
    $stmtInsArtigo->execute();
    $stmtInsArtigo->close();
}

$qArtigos = "SELECT idArtigo,tituloArtigo,textoArtigo,dataArtigo FROM artigos ORDER BY dataArtigo DESC";
$stmtArtigos = $conn->prepare($qArtigos);
if ($stmtArtigos === FALSE) {
    die("Erro no SQL: " . $qArtigos . " Error: " . $conn->error);
}
$stmtArtigos->execute();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backoffice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Backoffice</h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Título</th>
                    <th scope="col">Data</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmtArtigos->bind_result($idArtigo, $tituloArtigo, $textoArtigo, $dataArtigo);
                while ($stmtArtigos->fetch()) {
                ?>
                    <tr>
                        <th scope="row"><?= $idArtigo ?></th>
                        <td><?= $tituloArtigo ?></td>
                        <td><?= $dataArtigo ?></td>
                        <td>
                            <form action="index.php" method="POST">
                                <div class="mb-3">
                                    <input type="hidden" class="form-control" id="acao" name="acao" value="apagar">
                                    <input type="hidden" class="form-control" id="idartigo" name="idartigo" value="<?= $idArtigo ?>">
                                </div>
                                <button type="submit" class="btn btn-primary">Apagar</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <hr>
        <form action="index.php" method="POST">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo">
                <label for="texto" class="form-label">Texto</label>
                <input type="text" class="form-control" id="texto" name="texto">
            </div>
            <button type="submit" class="btn btn-primary">Adicionar artigo</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>