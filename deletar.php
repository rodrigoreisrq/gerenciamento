<?php

include 'conexao.php';
include 'auth.php';

$id = $_GET["id"];


$sql = "DELETE FROM produtos WHERE id = :id";
$stmt = $pdo->prepare($sql);
    $stmt->execute([
        ":id"=> $id
]);

header("Location: produtos.php");
exit;

?>