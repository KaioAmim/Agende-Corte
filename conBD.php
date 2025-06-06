<?php
$servername = "localhost";  // Nome do servidor
$username = "root";  // Nome de usuário do banco de dados
$password = "";    // Senha do banco de dados
$dbname = "bdbarbearia";    // Nome do banco de dados

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Definir o charset como UTF-8
$conn->set_charset("utf8");
?>