<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}

// Seção para processar o envio de vídeos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['video'])) {
    // Caminho onde os vídeos serão armazenados (certifique-se de ter permissão de escrita)
    $caminho_uploads = 'uploads/videos/';

    // Nome do arquivo (pode adotar uma lógica mais elaborada para evitar sobreposição de nomes)
    $nome_arquivo = basename($_FILES['video']['name']);

    // Caminho completo do arquivo
    $caminho_completo = $caminho_uploads . $nome_arquivo;

    // Move o arquivo para o diretório de uploads
    move_uploaded_file($_FILES['video']['tmp_name'], $caminho_completo);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Meu Curso Online</title>
    <style>
        /* Seus estilos CSS aqui... */
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Bem-vindo ao Dashboard, <?php echo $_SESSION['usuario']; ?>!</h1>

        <div class="video-container">
            <video id="cursoVideo" controls>
                <!-- Adicione o código PHP para obter o caminho do vídeo dinamicamente -->
                <?php
                $video_padrao = 'videos/teste.mp4';
                $video_atual = isset($_POST['video']) ? $caminho_uploads . basename($_POST['video']) : $video_padrao;
                ?>
                <source src="<?php echo $video_atual; ?>" type="video/mp4">
                Seu navegador não suporta o elemento de vídeo.
            </video>
        </div>

        <!-- Formulário para envio de vídeos -->
        <form action="dashboard.php" method="post" enctype="multipart/form-data">
            <label for="video">Enviar Vídeo:</label>
            <input type="file" id="video" name="video" accept="video/*" required>
            <button type="submit">Enviar Vídeo</button>
        </form>

        <div class="botao-container">
            <button class="botao" onclick="mudarVideo('videos/video1.mp4')">Vídeo 1</button>
            <button class="botao" onclick="mudarVideo('videos/video2.mp4')">Vídeo 2</button>
            <!-- Adicione mais botões conforme necessário -->
        </div>

        <a href="logout.php" class="logout-button">Sair</a>
    </div>

    <script>
        function mudarVideo(source) {
            document.getElementById('cursoVideo').src = source;
        }
    </script>
</body>
</html>
