<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Funcionário</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Login de Funcionário</h2>
        
        <!-- Formulário de Login -->
        <form id="form-login" method="POST" action="index.php?controller=home&action=login">
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <button type="submit">Entrar</button>
        </form>

        <!-- Mensagem de Erro -->
        <div id="error-message" style="color: red; margin-top: 10px;"></div>
    </div>

    <!-- Script para tratamento de erro e validação -->
    <script src="assets/js/script.js"></script>
</body>
</html>

