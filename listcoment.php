<?php
require_once('connection/connection.php');

$qComentarios = "SELECT comentario,nome FROM comentarios WHERE idArtigo=? ORDER BY data DESC";
$stmtComentarios = $conn->prepare($qComentarios);
if ($stmtComentarios === FALSE) {
    die("Erro no SQL: " . $qComentarios . " Error: " . $conn->error);
}
if (isset($_GET['idArtigo']) && $_GET['idArtigo'] != "") {
    $idArtigo = $_GET['idArtigo'];
} else {
    $idArtigo = 0;
}
$stmtComentarios->bind_param('i',$idArtigo);
$stmtComentarios->execute();
//$stmtComentarios->store_result();
//$totalArtigos = $stmtComentarios->num_rows;
$stmtComentarios->bind_result($comentario,$nome);
$resposta = array();
$i=0;
while ($stmtComentarios->fetch()) { 
    //echo $comentario;
    $resposta[$i++]=array('comentario'=>$comentario,'nome'=>$nome);
}
$stmtComentarios->close();
$conn->close();
echo json_encode($resposta);
?>