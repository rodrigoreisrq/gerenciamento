<?php

$host = "127.0.0.1";
$banco = "gerenciamento";
$usuario = "root";
$senha = "";

try {
    $pdo = new PDO("mysql:host=$host;port=3306;dbname=$banco;charset=utf8", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}



?>
