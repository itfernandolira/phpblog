<?php
    require_once('connection/connection.php');

    $sqlComentario = "INSERT INTO comentarios(idArtigo,comentario,nome) VALUES(?,?,?)";
    $stmtComentario = $conn->prepare($sqlComentario);
    if ($stmtComentario === FALSE) {
        die("Erro no SQL: " . $sqlComentario . " Error: " . $conn->error);
    }
    $idArtigo = $_POST['addArtigo'];
    $nome=$_POST['addNome'];
    $comentario=$_POST['addComentario'];
    $stmtComentario->bind_param('iss', $idArtigo,$comentario,$nome);
    $stmtComentario->execute();
    $stmtComentario->close();

    //$resposta = array('nome'=>$_POST['addNome']);
    //$resposta += array('comentario'=>$_POST['addComentario']);

    $resposta = array('status'=>'Obrigado pelo comentário!');

    echo json_encode($resposta);
?>