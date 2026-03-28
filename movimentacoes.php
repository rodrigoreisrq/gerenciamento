<?php
include 'auth.php';
include 'conexao.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $id_produto = $_POST["id_produto"];
    $tipo       = $_POST["tipo"];
    $quantidade = $_POST["quantidade"];
    $id_usuario = $_SESSION["usuario_id"];

    $sql = "INSERT INTO movimentacoes (id_produto, id_usuario, tipo, quantidade)
            VALUES (:id_produto, :id_usuario, :tipo, :quantidade)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ":id_produto" => $id_produto,
        ":id_usuario" => $id_usuario,
        ":tipo"       => $tipo,
        ":quantidade" => $quantidade
    ]);

    if($tipo == "entrada"){
        $sql_update = "UPDATE produtos SET quantidade = quantidade + :quantidade WHERE id = :id_produto";
    } else {
        $sql_update = "UPDATE produtos SET quantidade = quantidade - :quantidade WHERE id = :id_produto";
    }

    $stmt = $pdo->prepare($sql_update);
    $stmt->execute([
        ":quantidade" => $quantidade,
        ":id_produto" => $id_produto
    ]);

    header("Location: movimentacoes.php");
    exit;
}

$stmt    = $pdo->query("SELECT id, nome FROM produtos");
$produtos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movimentações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4">
    <span class="navbar-brand fw-bold">📦 Gerenciamento de Estoque</span>
    <a href="logout.php" class="btn btn-sm btn-outline-light">Sair</a>
</nav>

<div class="container mt-4" style="max-width: 600px;">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Registrar Movimentação</h4>
        <a href="produtos.php" class="btn btn-sm btn-secondary">← Voltar</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="movimentacoes.php">

                <div class="mb-3">
                    <label class="form-label">Produto</label>
                    <select name="id_produto" class="form-select">
                        <?php foreach($produtos as $produto): ?>
                            <option value="<?= $produto['id'] ?>"><?= htmlspecialchars($produto['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo</label>
                    <select name="tipo" class="form-select">
                        <option value="entrada">Entrada</option>
                        <option value="saida">Saída</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Quantidade</label>
                    <input type="number" class="form-control" name="quantidade" min="1" required>
                </div>

                <button type="submit" class="btn btn-success w-100">Confirmar Movimentação</button>
            </form>
        </div>
    </div>

</div>
</body>
</html>