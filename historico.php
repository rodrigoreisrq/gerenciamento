<?php
include 'auth.php';
include 'conexao.php';

$stmt = $pdo->query("SELECT m.tipo, m.quantidade, m.data,
    p.nome AS produto,
    u.nome AS usuario
FROM movimentacoes m
JOIN produtos p ON m.id_produto = p.id
JOIN usuarios u ON m.id_usuario = u.id
ORDER BY m.data DESC");

$movimentacoes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Movimentações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4">
    <span class="navbar-brand fw-bold">📦 Gerenciamento de Estoque</span>
    <a href="logout.php" class="btn btn-sm btn-outline-light">Sair</a>
</nav>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Histórico de Movimentações</h4>
        <a href="produtos.php" class="btn btn-sm btn-secondary">← Voltar</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped table-bordered table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Tipo</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Usuário</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($movimentacoes as $mov): ?>
                    <tr>
                        <td>
                            <?php if($mov["tipo"] == "entrada"): ?>
                                <span class="badge bg-success">Entrada</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Saída</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($mov["produto"]) ?></td>
                        <td><?= $mov["quantidade"] ?></td>
                        <td><?= htmlspecialchars($mov["usuario"]) ?></td>
                        <td><?= $mov["data"] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>
</html>