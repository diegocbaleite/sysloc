<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "sysloc";

// Criar conexão
$conexao = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conexao->connect_error) {
    die("Connection failed: " . $conexao->connect_error);
}