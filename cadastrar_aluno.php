<?php
session_start();

// Verifica se o usuário é um administrador
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: admin.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenha os dados do formulário
    $nome_aluno = $_POST['nome_aluno'];
    $codigo_aluno_cadastro = $_POST['codigo_aluno_cadastro'];
    $senha_cadastro = password_hash($_POST['senha_cadastro'], PASSWORD_DEFAULT); // Armazenar a senha de forma segura

    // Formate os dados para salvar no arquivo
    $dados_aluno = "$nome_aluno|$codigo_aluno_cadastro|$senha_cadastro\n";

    // Abre o arquivo para escrita (append mode)
    $arquivo = fopen('alunos.txt', 'a');

    // Escreve os dados no arquivo
    fwrite($arquivo, $dados_aluno);

    // Fecha o arquivo
    fclose($arquivo);

    // Redireciona de volta para a página de login após o cadastro
    header('Location: index.php');
    exit();
}

// Função para exibir a lista de alunos cadastrados
function mostrarAlunos() {
    $alunos = file('alunos.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if (!empty($alunos)) {
        echo '<h2>Alunos Cadastrados</h2>';
        echo '<ul>';
        foreach ($alunos as $aluno) {
            list($nome, $codigo, $senha_hash) = explode('|', $aluno);
            echo "<li><strong>$nome</strong> - Código: $codigo</li>";
        }
        echo '</ul>';
    } else {
        echo '<p>Nenhum aluno cadastrado ainda.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Aluno - Meu Curso Online</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .login-container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 2em;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h1, h2 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 0.5em;
        }

        input {
            padding: 0.8em;
            margin-bottom: 1em;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        button {
            background-color: #333;
            color: #fff;
            padding: 0.8em;
            border: none;
            cursor: pointer;
            border-radius: 3px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #555;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Área do Administrador</h1>
        <form action="cadastrar_aluno.php" method="post">
            <label for="nome_aluno">Nome do Aluno:</label>
            <input type="text" id="nome_aluno" name="nome_aluno" required>

            <label for="codigo_aluno_cadastro">Código do Aluno:</label>
            <input type="text" id="codigo_aluno_cadastro" name="codigo_aluno_cadastro" required>

            <label for="senha_cadastro">Senha:</label>
            <input type="password" id="senha_cadastro" name="senha_cadastro" required>

            <button type="submit">Cadastrar</button>
        </form>

        <?php mostrarAlunos(); ?>
    </div>
</body>
</html>
