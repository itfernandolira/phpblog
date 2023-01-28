<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../connection/connection.php');

$numUsers = -1;

if (isset($_POST['nomeUtilizador']) && $_POST['nomeUtilizador'] != "") {
    //verificar na BD se o username e password estão corretos
    //echo $_POST['nomeUtilizador'];
    $qUsers = "SELECT nomeUtilizador,palavraPasse,nome FROM utilizadores WHERE nomeUtilizador = ? and palavraPasse = md5(?)";
    $nomeUtilizador=$_POST['nomeUtilizador'];
    $palavraPasse=$_POST['palavraPasse'];

    $stmtUsers = $conn->prepare($qUsers);
    if ($stmtUsers === FALSE) {
        die("Erro no SQL: " . $qUsers . " Error: " . $conn->error);
    }

    $stmtUsers->bind_param('ss', $nomeUtilizador,$palavraPasse);
    $stmtUsers->execute();
    $stmtUsers->store_result();
    $numUsers = $stmtUsers->num_rows;
    $stmtUsers->bind_result($resNomeUtilizador,$resPalavraPasse,$resNome);
    $stmtUsers->fetch();

    // echo $numUsers;
    if ($numUsers == 1) {
        $_SESSION['utilizador'] = $_POST['nomeUtilizador'];
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="nomeUtilizador" class="form-label">Username</label>
                <input type="text" class="form-control" id="nomeUtilizador" name="nomeUtilizador">
                <label for="palavraPasse" class="form-label">Password</label>
                <input type="password" class="form-control" id="palavraPasse" name="palavraPasse">
            </div>
            <button type="submit" class="btn btn-primary">LOGIN</button>
            <?php if ($numUsers == 0) {
                echo "<p>Username / Password inválidos!</p>";
            } ?>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <?php
    $conn->close();
    ?>
</body>
</html>