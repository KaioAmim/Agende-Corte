<?php
// Inclui a conexão com o banco de dados
include('conBD.php');

session_start();
// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: TelaLogin.php?error=Você precisa estar logado para acessar o carrinho.");
    exit();
}
if (isset($_POST['datacorte']) && isset($_POST['horario'])) {
    $datacorte = $_POST['datacorte'];
    $horario = $_POST['horario'];
    // Aqui você pode adicionar o produto ao carrinho
}

$userId = $_SESSION['user_id'];
$query = "SELECT SUM(quantity) AS total_items FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$cartItemCount = $row['total_items'] ?? 0;
$query = "SELECT * FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css"/>
    <link rel="stylesheet" href="CSS/carrinho.css" />
    <link rel="icon" type="image/x-icon" href="images/logo.png">

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
</head>
<body>

<!--BARRA DE MENU -->
<div class="menu w3-bottombar reveal" style="z-index:1;">
    <strong><a href="Principal.php"><i class="fa fa-home" style="font-size:25px"></i></a></strong>
    <p class="roboto-medium"><a class="itensMenu" href="cortes.php"><strong>Cortes</strong></a></p>
    <p class="roboto-medium"><a class="itensMenu" href="pacotes.php"><strong>Pacotes</strong></a></p>
    <p class="roboto-medium"><a class="itensMenu" href="agenda.php"><strong>Agenda</strong></a></p>
    <div style="margin-left: auto;" class="icones-direita">
        <a href="carrinho.php" class="carrinho"style="margin-right: 15px; "><i class="fa fa-shopping-cart"style="font-size:25px"></i> <span class="cart-count"><?php echo $cartItemCount; ?></span></a>
        <div class="user-menu">
            <a href="#"><i class="fa fa-user-circle w3-padding-top"style="font-size:35px"></i></a>
            <div class="dropdown-content">
                <li class="w3-ul w3-padding"><strong>Nome: </strong> <?php echo htmlspecialchars($_SESSION['user_nome']); ?></li>
                <a href="logout.php" style="font-size:12px">Sair <i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</div>
<main>
    <div class="page-title w3-text-white">Seu Carrinho</div>
    <div class="content">
        <section>
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Total</th>
                        <th>-</th>
                    </tr>
                </thead>
                <tbody class="w3-text-white">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($item = $result->fetch_assoc()) {
                            $itemTotal = $item['price'] * $item['quantity'];
                            $total += $itemTotal;
                            echo '
                            <tr>
                                <td>
                                    <div class="product">
                                        <img src="images/' . $item['image'] . '" alt="' . $item['name'] . '" width="100" height="110" />
                                        <div class="info">
                                            <div class="name">' . $item['name'] . '</div>
                                        </div>
                                    </div>
                                </td>
                                <td>R$ ' . number_format($item['price'], 2, ',', '.') . '</td>
                                <td>
                                    <div class="qty">
                                        <button onclick="changeQuantity(' . $item['product_id'] . ', -1)"><i class="bx bx-minus"></i></button>
                                        <span class="w3-text-black">' . $item['quantity'] . '</span>
                                        <button onclick="changeQuantity(' . $item['product_id'] . ', 1)"><i class="bx bx-plus"></i></button>
                                    </div>
                                </td>
                                <td>R$ ' . number_format($itemTotal, 2, ',', '.') . '</td>
                                <td>
                                    <button class="remove" onclick="removeItem(' . $item['product_id'] . ')"><i class="bx bx-x"></i></button>
                                </td>
                            </tr>';
                        }
                    } else {
                        echo '<tr><td colspan="5" class="w3-center">Seu carrinho está vazio!</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <aside>
            <div class="box">
                <header>Resumo da compra</header>
                <?php
            // Corrigir o caminho do arquivo conexao.php
            include('conBD.php');

            // Verificar se a sessão já está ativa
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $user_id = $_SESSION['user_id']; // Certifique-se que o user_id está na sessão

            // Consulta para pegar o agendamento do usuário logado
            $sql = "SELECT data_corte, horario FROM agendamentos WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id); // 'i' indica inteiro
            $stmt->execute();
            $result = $stmt->get_result();

            // Exibir os resultados
            if ($result->num_rows > 0) {
                $agendamento = $result->fetch_assoc();
                $dataCorte = $agendamento['data_corte'];
                $horario = $agendamento['horario'];
            } else {
                $dataCorte = "N/A";
                $horario = "N/A";
            }

            $stmt->close();
            $conn->close();
            ?>
                <div class="info">
                    <div><span>Sub-total</span><span>R$ <?php echo number_format($total, 2, ',', '.'); ?></span></div>
                    <div id="dia"><span id="selectedDateDisplay">Data</span><?php echo $dataCorte; ?></div>
                    <div id="horario"><span id="selectedTimeDisplay">Horário</span><?php echo $horario; ?></div>

                </div>
                <footer>
                    <span>Total</span>
                    <span>R$ <?php echo number_format($total, 2, ',', '.'); ?></span>
                </footer>
            </div>
            <button onclick="window.location.href='Pagamento.php'">Finalizar Compra</button>
        </aside>
    </div>
</main>

<script>
    function changeQuantity(itemId, change) {
        // Aqui você pode usar AJAX para enviar a mudança de quantidade ao banco de dados e atualizar a página
        window.location.href = `update_cart.php?id=${itemId}&change=${change}`;
    }

    function removeItem(itemId) {
        // Aqui você pode usar AJAX para remover o item do banco de dados e atualizar a página
        window.location.href = `remove_from_cart.php?id=${itemId}`;
    }
    function changeQuantity(itemId, change) {
    window.location.href = `update_cart.php?id=${itemId}&change=${change}`;
}

    function removeItem(itemId) {
        window.location.href = `remove_from_cart.php?id=${itemId}`;
    }

</script>

</body>
</html>
