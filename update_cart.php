<?php
session_start();
include('conBD.php'); // Inclua a conexão com o banco de dados

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: TelaLogin.php");
    exit();
}

if (isset($_GET['id'], $_GET['change'])) {
    $userId = $_SESSION['user_id']; // ID do usuário logado
    $productId = $_GET['id'];
    $change = (int)$_GET['change'];

    // Busca o produto no carrinho
    $query = "SELECT quantity FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();

    if ($item) {
        $newQuantity = $item['quantity'] + $change;
        if ($newQuantity > 0) {
            // Atualiza a quantidade no banco de dados
            $query = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("iii", $newQuantity, $userId, $productId);
            $stmt->execute();
        } else {
            // Se a quantidade for menor que 1, remove o item
            $query = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $userId, $productId);
            $stmt->execute();
        }
    }
}

// Redireciona de volta para o carrinho
header("Location: carrinho.php");
exit();
?>
