<?php
session_start();
include('conBD.php'); // Inclua a conexão com o banco de dados

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: TelaLogin.php");
    exit();
}

if (isset($_GET['id'])) {
    $userId = $_SESSION['user_id']; // ID do usuário logado
    $productId = $_GET['id'];

    // Remove o produto do carrinho
    $query = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();
}

// Redireciona de volta para o carrinho
header("Location: carrinho.php");
exit();
?>
