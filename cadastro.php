
<?php
include 'conexao.php';

$erro = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome  = $_POST["nome"];
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    // verifica se email já existe
    $check = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
    $check->execute([":email" => $email]);

    if($check->fetch()){
        $erro = "Este email já está cadastrado.";
    } else {
        $sql  = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":nome"  => $nome,
            ":email" => $email,
            ":senha" => $senha
        ]);

        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark d-flex align-items-center justify-content-center" style="min-height: 100vh;">

<div class="card shadow" style="width: 100%; max-width: 400px;">
    <div class="card-body p-4">

        <h4 class="text-center mb-1">📦 Estoque</h4>
        <p class="text-center text-muted mb-4">Crie sua conta</p>

        <?php if($erro): ?>
            <div class="alert alert-danger"><?= $erro ?></div>
        <?php endif; ?>

        <form method="POST" action="cadastro.php">
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Senha</label>
                <input type="password" class="form-control" name="senha" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
        </form>

        <p class="text-center mt-3 mb-0">
            Já tem conta? <a href="login.php">Faça login</a>
        </p>

    </div>
</div>

</body>
</html>


?>