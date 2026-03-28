<?php

$host = "sql206.infinityfree.com";
$banco = "if0_41494744_gerenciamento";
$usuario = "if0_41494744";
$senha = "rodrigo15821";

try {
    $pdo = new PDO("mysql:host=$host;port=3306;dbname=$banco;charset=utf8", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}



?>