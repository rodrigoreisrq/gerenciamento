<?php
include 'conexao.php';

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql  = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":email" => $email]);
    $usuario = $stmt->fetch();

    if($usuario && password_verify($senha, $usuario["senha"])){
        $_SESSION["usuario_id"]   = $usuario["id"];
        $_SESSION["usuario_nome"] = $usuario["nome"];
        header("Location: produtos.php");
        exit;
    } else {
        $erro = "Email ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark d-flex align-items-center justify-content-center" style="min-height: 100vh;">



<div class="card shadow" style="width: 100%; max-width: 400px;">
    <div class="card-body p-4">

        <h4 class="text-center mb-1">📦 Estoque</h4>
        <p class="text-center text-muted mb-4">Faça login para continuar</p>

        <?php if(isset($erro)): ?>
            <div class="alert alert-danger"><?= $erro ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Senha</label>
                <input type="password" class="form-control" name="senha" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>

        <p class="text-center mt-3 mb-0">
            Não tem conta? <a href="cadastro.php">Cadastre-se</a>
        </p>

    </div>
</div>

</body>
</html>