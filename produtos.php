<?php
include 'conexao.php';
include 'auth.php';

$stmt = $pdo->query("SELECT * FROM produtos");
$produtos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4">
    <span class="navbar-brand fw-bold">📦 Gerenciamento de Estoque</span>
    <a href="logout.php" class="btn btn-sm btn-outline-light">Sair</a>
</nav>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Produtos em Estoque</h4>
        <div>
            <a href="adicionar.php" class="btn btn-primary btn-sm">+ Adicionar Produto</a>
            <a href="movimentacoes.php" class="btn btn-success btn-sm ms-2">Movimentar</a>
            <a href="historico.php" class="btn btn-secondary btn-sm ms-2">Histórico</a>
        </div>
    </div>

    <table class="table table-striped table-bordered table-hover bg-white">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Fabricação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($produtos as $produto): ?>
            <tr>
                <td><?= htmlspecialchars($produto["nome"]) ?></td>
                <td>R$ <?= number_format($produto["preco"], 2, ',', '.') ?></td>
                <td><?= $produto["quantidade"] ?></td>
                <td><?= $produto["fabricacao"] ?></td>
                <td>
                    <a href="editar.php?id=<?= $produto["id"] ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="deletar.php?id=<?= $produto["id"] ?>" class="btn btn-sm btn-danger"
                       onclick="return confirm('Confirma exclusão?')">Deletar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
</body>
</html>