<?php
session_start();
include_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ajuste a consulta para usar prepared statements para evitar SQL injection
    $stmt = $conexao->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifique se a consulta foi bem-sucedida
    if ($result) {
        if ($result->num_rows < 1) {
            $_SESSION['error'] = "Usuário ou senha incorretos!";
            header('Location: login.php');
            exit;
        } else {
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['username'];
            $_SESSION['password'] = $row['password'];
            header('Location: home.php');
            exit;
        }
    } else {
        // Tratamento de erro caso a consulta falhe
        echo "Erro na consulta: " . $conexao->error;
    }

    // Fechar a declaração
    $stmt->close();
}

// Fechar a conexão
$conexao->close();
