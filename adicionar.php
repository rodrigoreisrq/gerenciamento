<?php
include 'conexao.php';
include 'auth.php';

$sucesso = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome       = $_POST["nome"];
    $preco      = $_POST["preco"];
    $quantidade = $_POST["quantidade"];
    $fabricacao = $_POST["fabricacao"];

    $sql = "INSERT INTO produtos (nome, preco, quantidade, fabricacao)
            VALUES (:nome, :preco, :quantidade, :fabricacao)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ":nome"       => $nome,
        ":preco"      => $preco,
        ":quantidade" => $quantidade,
        ":fabricacao" => $fabricacao
    ]);

    header("Location: produtos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4">
    <span class="navbar-brand fw-bold">📦 Gerenciamento de Estoque</span>
    <a href="logout.php" class="btn btn-sm btn-outline-light">Sair</a>
</nav>

<div class="container mt-4" style="max-width: 600px;">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Adicionar Produto</h4>
        <a href="produtos.php" class="btn btn-sm btn-secondary">← Voltar</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="adicionar.php">

                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" name="nome" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Preço</label>
                    <input type="number" step="0.01" class="form-control" name="preco" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Quantidade</label>
                    <input type="number" class="form-control" name="quantidade" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fabricação</label>
                    <input type="date" class="form-control" name="fabricacao">
                </div>

                <button type="submit" class="btn btn-primary w-100">Adicionar Produto</button>
            </form>
        </div>
    </div>

</div>
</body>
</html>
