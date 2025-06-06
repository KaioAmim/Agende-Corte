<?php
session_start();
include('conBD.php'); // Inclua o arquivo de conexão com o banco de dados

// Verifique se a conexão com o banco de dados está funcionando
if (!$conn) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

// Verifique se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: TelaLogin.php?error=Você precisa estar logado para adicionar produtos ao carrinho.");
    exit();
}

// Verifique se os dados do produto foram enviados
if (isset($_POST['product_id'], $_POST['product_name'], $_POST['product_price'], $_POST['product_img'])) {
    $userId = $_SESSION['user_id']; // ID do usuário logado
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $productImg = $_POST['product_img']; // Imagem do produto

    // Verifique se o produto já está no carrinho para o usuário logado
    $query = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Produto já está no carrinho, então aumentamos a quantidade
        $query = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $userId, $productId);
        $stmt->execute();
    } else {
        // Se o produto não está no carrinho, insira um novo item
        $query = "INSERT INTO cart (user_id, product_id, name, price, image, quantity) VALUES (?, ?, ?, ?, ?, 1)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iisss", $userId, $productId, $productName, $productPrice, $productImg);
        $stmt->execute();
    }

    // Redirecione para a página do carrinho
    header("Location: carrinho.php?success=Produto adicionado ao carrinho com sucesso!");
    exit();
}
?>
