<?php
session_start();
// Verifica se o usuário está autenticado e se a variável de sessão 'usuario' está definida
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}
?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Meu Curso Online</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #000;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .dashboard-container {
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
            max-width: 800px;
            width: 100%;
            text-align: center;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .video-container {
            position: relative;
            overflow: hidden;
            padding-top: 56.25%; /* Proporção 16:9 para vídeos responsivos */
            border-radius: 10px;
            margin-bottom: 20px;
        }

        video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 10px;
        }

        .botao-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 20px;
        }

        .botao {
            background-color: #555;
            color: #fff;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-bottom: 10px;
        }

        .botao:hover {
            background-color: #777;
        }

        .logout-button {
            color: #fff;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            border: 1px solid #fff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Bem-vindo ao Dashboard, <?php echo $_SESSION['usuario']; ?>!</h1>

        <div class="video-container">
            <video id="cursoVideo" controls>
                <source src="videos/Treinando_ADM.mp4" type="video/mp4">
                Seu navegador não suporta o elemento de vídeo.
            </video>
        </div>

        <div class="botao-container">
            <button class="botao" onclick="mudarVideo('videos/Treinando_ADM.mp4')">Vídeo 1</button>
            <button class="botao" onclick="mudarVideo('videos/discordpearls_1357713391943573505488P.mp4')">Vídeo 2</button>
            <button class="botao" onclick="mudarVideo('videos/video3.mp4')">Vídeo 3</button>
            <button class="botao" onclick="mudarVideo('videos/video4.mp4')">Vídeo 4</button>
            <button class="botao" onclick="mudarVideo('videos/video5.mp4')">Vídeo 5</button>
            <button class="botao" onclick="mudarVideo('videos/video6.mp4')">Vídeo 6</button>
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
