<?php

session_start();
include_once 'conBD.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $telefone = $conn->real_escape_string($_POST['txtTel']);
    $senha = $_POST['txtSenha'];

    // Consulta para verificar se o usuário existe
    $sql = "SELECT * FROM cadastro WHERE telefone = '$telefone'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verificar se a senha está correta
        if (password_verify($senha, $row['senha'])) {
            // Iniciar sessão do usuário
            $_SESSION['user_id'] = $row['id_cadastro'];
            $_SESSION['user_nome'] = $row['nome'];  // Opcional: armazenar o nome do usuário
            header("Location: Principal.php");
            exit();
        } else {
            // Senha incorreta
            $_SESSION['error'] = 'Senha incorreta!';
            header("Location: TelaLogin.php");
            exit();
        }
    } else {
        // Usuário não encontrado
        $_SESSION['error'] = 'Usuário não encontrado! Por favor, cadastre-se.';
        header("Location: TelaLogin.php");
        exit();
    }

    $conn->close();
}
?>