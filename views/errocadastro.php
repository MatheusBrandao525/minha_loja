<?php
session_start();

// Verificar se há uma mensagem de erro armazenada na sessão
$erroMensagem = isset($_SESSION['erro_cadastro']) ? $_SESSION['erro_cadastro'] : 'Ocorreu um erro desconhecido.';

// Limpar a mensagem de erro após exibi-la
unset($_SESSION['erro_cadastro']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro no Cadastro</title>
    <style>
        /* styles.css */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 30px;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        h1 {
            color: #d9534f;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        p {
            color: #333;
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        button {
            background-color: #d9534f;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            font-size: 1rem;
            padding: 10px 20px;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #c9302c;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Erro no Cadastro</h1>
        <p><?php echo htmlspecialchars($erroMensagem); ?></p>
        <a href="cadastro"><button>Tentar Novamente</button></a>
    </div>
</body>


</html>