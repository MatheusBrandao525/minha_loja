<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agradecimento pela Avaliação</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .agradecimento-container {
            background-color: #fff;
            padding: 2rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            border-radius: 8px;
        }
        .agradecimento-container h1 {
            font-size: 24px;
            margin-bottom: 1rem;
        }
        .agradecimento-container p {
            font-size: 18px;
            margin-bottom: 2rem;
        }
        .agradecimento-container button {
            padding: 0.5rem 1rem;
            font-size: 16px;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .agradecimento-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="agradecimento-container">
        <h1>Obrigado pela sua Avaliação!</h1>
        <p>Agradecemos seu feedback. Sua opinião é muito importante para nós.</p>
        <button onclick="window.location.href='home'">Voltar para a Tela Inicial</button>
    </div>
</body>
</html>
