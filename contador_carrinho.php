<?php
// cart_counter.php

session_start();

// Verifica se o usuário está logado e obtem o ID do usuário
if (!isset($_SESSION['user_id'])) {
    echo 0; // Se não estiver logado, o contador é zero
    exit;
}

$user_id = $_SESSION['user_id'];

// Conecte-se ao banco de dados
$host = 'bdbarbearia.mysql.dbaas.com.br'; // Ajuste conforme necessário
$dbname = 'bdbarbearia'; // Substitua pelo nome do seu banco de dados
$username = 'bdbarbearia'; // Ajuste conforme necessário
$password = 'Kf031106@'; // Ajuste conforme necessário

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query para contar os itens no carrinho do usuário logado
    $stmt = $pdo->prepare("SELECT SUM(quantity) as total_quantity FROM cart WHERE user_id = ?");
    $stmt->execute([$user_id]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_quantity = $result['total_quantity'] ? $result['total_quantity'] : 0;

    echo $total_quantity; // Exibe o número total de produtos no carrinho

} catch (PDOException $e) {
    echo 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
}
